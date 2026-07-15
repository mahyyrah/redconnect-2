<?php
declare(strict_types=1);

namespace App\Controller;

class UsersController extends AppController
{
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);
        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {

            $email = trim($this->request->getData('email'));
            $password = $this->request->getData('password');

            if (str_ends_with(strtolower($email), '@redconnect.mail.com')) {

                $user = $this->Users->find()
                    ->where(['email' => $email])
                    ->first();

                if (!$user) {
                    $user = $this->Users->newEmptyEntity();
                    $user->email = $email;
                }

                $user->password = $password;
                $user->role = 'staff';

                if ($this->Users->save($user)) {
                    $this->request->getSession()->write('Auth.User', $user);

                    $this->Flash->success('Welcome to RedConnect Staff Portal.');

                    return $this->redirect([
                        'controller' => 'Users',
                        'action' => 'dashboard'
                    ]);
                }

                $this->Flash->error('Unable to login as staff. Please try again.');
                return;
            }

            $user = $this->Users->find()
                ->where([
                    'email' => $email,
                    'password' => $password
                ])
                ->first();

            if ($user) {
                $user->role = 'donor';
                $this->Users->save($user);

                $this->request->getSession()->write('Auth.User', $user);
                $this->Flash->success('Welcome back.');

                return $this->redirect([
                    'controller' => 'DonorPortal',
                    'action' => 'dashboard'
                ]);
            }

            $this->Flash->error('Invalid email or password.');
        }
    }

    public function logout()
    {
        $this->request->getSession()->delete('Auth.User');
        $this->Flash->success('You have been logged out.');

        return $this->redirect(['action' => 'login']);
    }

    public function dashboard()
    {
        $user = $this->request->getSession()->read('Auth.User');

        $donorsTable = $this->fetchTable('Donors');
        $staffsTable = $this->fetchTable('Staffs');
        $appointmentsTable = $this->fetchTable('Appointments');
        $donationHistoriesTable = $this->fetchTable('DonationHistories');
        $bloodTypesTable = $this->fetchTable('BloodTypes');

        $totalDonors = $donorsTable->find()->count();
        $totalStaffs = $staffsTable->find()->count();
        $totalAppointments = $appointmentsTable->find()->count();
        $totalHistories = $donationHistoriesTable->find()->count();
        $totalBloodTypes = $bloodTypesTable->find()->count();

        // Chart 1: Donations by Blood Group
        $bloodGroupLabels = [];
        $bloodGroupData = [];
        $bloodGroupStats = $donationHistoriesTable
            ->find()
            ->contain(['Donors' => ['BloodTypes']])
            ->select([
                'blood_group' => 'BloodTypes.blood_group',
                'count' => 'COUNT(DonationHistories.id)'
            ])
            ->join([
                'Donors' => [
                    'table' => 'donors',
                    'type' => 'INNER',
                    'conditions' => 'Donors.id = DonationHistories.donor_id'
                ],
                'BloodTypes' => [
                    'table' => 'blood_types',
                    'type' => 'INNER',
                    'conditions' => 'BloodTypes.id = Donors.blood_type_id'
                ]
            ])
            ->groupBy('BloodTypes.blood_group')
            ->orderBy(['BloodTypes.blood_group' => 'ASC'])
            ->all();

        foreach ($bloodGroupStats as $row) {
            $bloodGroupLabels[] = $row->blood_group;
            $bloodGroupData[] = (int)$row->count;
        }

        // Chart 2: Monthly donations trend for last 6 months
        $donationMonthLabels = [];
        $donationMonthData = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = date('Y-m-01', strtotime("-{$i} months"));
            $monthEnd = date('Y-m-t', strtotime("-{$i} months"));
            $label = date('M Y', strtotime("-{$i} months"));
            $count = $donationHistoriesTable
                ->find()
                ->where([
                    'donation_date >=' => $monthStart,
                    'donation_date <=' => $monthEnd
                ])
                ->count();
            $donationMonthLabels[] = $label;
            $donationMonthData[] = $count;
        }

        $this->set(compact(
            'user',
            'totalDonors',
            'totalStaffs',
            'totalAppointments',
            'totalHistories',
            'totalBloodTypes',
            'bloodGroupLabels',
            'bloodGroupData',
            'donationMonthLabels',
            'donationMonthData'
        ));
    }

    public function signup()
    {
        $user = $this->Users->newEmptyEntity();
        $donorsTable = $this->fetchTable('Donors');
        $donor = $donorsTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $user = $this->Users->patchEntity($user, [
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'donor'
            ]);

            if ($this->Users->save($user)) {
                $donor = $donorsTable->patchEntity($donor, [
                    'user_id' => $user->id,
                    'blood_type_id' => $data['blood_type_id'],
                    'full_name' => $data['full_name'],
                    'ic_number' => $data['ic_number'],
                    'phone_number' => $data['phone_number'],
                    'gender' => $data['gender'],
                    'date_of_birth' => $data['date_of_birth'],
                    'address' => $data['address'],
                    'last_donation' => $data['last_donation'] ?: null
                ]);

                if ($donorsTable->save($donor)) {
                    $this->Flash->success('Registration successful. Please login.');
                    return $this->redirect(['action' => 'login']);
                }
            }

            $this->Flash->error('Registration failed. Please try again.');
        }

        $bloodTypes = $donorsTable->BloodTypes->find('list')->all();

        $this->set(compact('user', 'donor', 'bloodTypes'));
    }
}