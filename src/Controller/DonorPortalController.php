<?php
declare(strict_types=1);

namespace App\Controller;

class DonorPortalController extends AppController
{
    private function getCurrentUser()
    {
        return $this->request->getSession()->read('Auth.User');
    }

    private function getCurrentDonor()
    {
        $user = $this->getCurrentUser();

        if (!$user) {
            return null;
        }

        return $this->fetchTable('Donors')
            ->find()
            ->contain(['BloodTypes'])
            ->where(['user_id' => $user->id])
            ->first();
    }

    public function dashboard()
    {
        $user = $this->getCurrentUser();
        $donor = $this->getCurrentDonor();

        $appointments = 0;
        $certificates = 0;
        $donations = 0;
        $bloodGroup = '-';

        // Chart data defaults
        $donationMonthLabels = [];
        $donationMonthData = [];
        $apptStatusLabels = ['Pending', 'Approved', 'Completed', 'Rejected'];
        $apptStatusData = [0, 0, 0, 0];

        if ($donor) {
            $appointments = $this->fetchTable('Appointments')
                ->find()
                ->where(['donor_id' => $donor->id])
                ->count();

            $donations = $this->fetchTable('DonationHistories')
                ->find()
                ->where(['donor_id' => $donor->id])
                ->count();

            $certificates = $this->fetchTable('Certificates')
                ->find()
                ->matching('DonationHistories', function ($q) use ($donor) {
                    return $q->where([
                        'DonationHistories.donor_id' => $donor->id
                    ]);
                })
                ->count();

            $bloodGroup = $donor->blood_type->blood_group ?? '-';

            // Chart 1: Donations per month for last 6 months
            $monthlyDonations = [];
            for ($i = 5; $i >= 0; $i--) {
                $monthStart = date('Y-m-01', strtotime("-{$i} months"));
                $monthEnd = date('Y-m-t', strtotime("-{$i} months"));
                $label = date('M Y', strtotime("-{$i} months"));
                $count = $this->fetchTable('DonationHistories')
                    ->find()
                    ->where([
                        'donor_id' => $donor->id,
                        'donation_date >=' => $monthStart,
                        'donation_date <=' => $monthEnd
                    ])
                    ->count();
                $donationMonthLabels[] = $label;
                $donationMonthData[] = $count;
            }

            // Chart 2: Appointments by status
            $statusMap = ['pending' => 0, 'approved' => 1, 'completed' => 2, 'rejected' => 3];
            $apptStatuses = $this->fetchTable('Appointments')
                ->find()
                ->select(['status', 'count' => 'COUNT(id)'])
                ->where(['donor_id' => $donor->id])
                ->groupBy('status')
                ->all();

            foreach ($apptStatuses as $row) {
                $statusKey = strtolower($row->status);
                if (isset($statusMap[$statusKey])) {
                    $apptStatusData[$statusMap[$statusKey]] = (int)$row->count;
                }
            }
        }

        $this->set(compact(
            'user',
            'donor',
            'appointments',
            'certificates',
            'donations',
            'bloodGroup',
            'donationMonthLabels',
            'donationMonthData',
            'apptStatusLabels',
            'apptStatusData'
        ));
    }

    public function profile()
    {
        $donor = $this->getCurrentDonor();

        $this->set(compact('donor'));
    }

    public function editProfile()
    {
        $donor = $this->getCurrentDonor();

        if (!$donor) {
            $this->Flash->error('Donor profile not found.');
            return $this->redirect(['action' => 'profile']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $donor->phone_number = $data['phone_number'] ?? $donor->phone_number;
            $donor->address = $data['address'] ?? $donor->address;

            if ($this->fetchTable('Donors')->save($donor)) {
                $this->Flash->success('Your profile has been updated.');
                return $this->redirect(['action' => 'profile']);
            }

            $this->Flash->error('Profile could not be updated. Please try again.');
        }

        $this->set(compact('donor'));
    }

    public function appointments()
    {
        $donor = $this->getCurrentDonor();

        if (!$donor) {
            $this->Flash->error('Donor profile not found.');
            return $this->redirect(['action' => 'dashboard']);
        }

        $appointmentsTable = $this->fetchTable('Appointments');
        $appointment = $appointmentsTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $appointment = $appointmentsTable->patchEntity(
                $appointment,
                $this->request->getData()
            );

            $appointment->donor_id = $donor->id;
            $appointment->status = 'pending';

            if ($appointmentsTable->save($appointment)) {
                $this->Flash->success('Your appointment has been booked and is pending approval.');
                return $this->redirect(['action' => 'appointments']);
            }

            $this->Flash->error('Appointment could not be booked. Please try again.');
        }

        $appointments = $appointmentsTable
            ->find()
            ->where([
                'donor_id' => $donor->id,
                'status !=' => 'completed'
            ])
            ->order(['appointment_date' => 'DESC'])
            ->all();

        $this->set(compact('donor', 'appointment', 'appointments'));
    }

    public function donationHistory()
    {
        $donor = $this->getCurrentDonor();

        $donationHistories = [];

        if ($donor) {
            $donationHistories = $this->fetchTable('DonationHistories')
                ->find()
                ->contain(['Staffs', 'Appointments', 'Certificates'])
                ->where(['DonationHistories.donor_id' => $donor->id])
                ->order(['DonationHistories.donation_date' => 'DESC'])
                ->all();
        }

        $this->set(compact('donor', 'donationHistories'));
    }

    public function certificates()
{
    $donor = $this->getCurrentDonor();

    $certificates = [];

    if ($donor) {

        $certificates = $this->fetchTable('Certificates')
            ->find()
            ->contain([
                'DonationHistories' => [
                    'Donors' => [
                        'BloodTypes'
                    ]
                ]
            ])
            ->matching('DonationHistories', function ($q) use ($donor) {
                return $q->where([
                    'DonationHistories.donor_id' => $donor->id
                ]);
            })
            ->order([
                'Certificates.issued_at' => 'DESC'
            ])
            ->all();
    }

    $this->set(compact(
        'donor',
        'certificates'
    ));
}

    public function viewCertificate($id = null)
{
    $donor = $this->getCurrentDonor();

    if (!$donor) {
        $this->Flash->error('Donor profile not found.');
        return $this->redirect(['action' => 'certificates']);
    }

    $certificate = $this->fetchTable('Certificates')->get($id, [
        'contain' => [
            'DonationHistories' => [
                'Donors' => [
                    'BloodTypes'
                ],
                'Staffs',
                'Appointments'
            ]
        ]
    ]);

    // Make sure the logged-in donor owns this certificate
    if ($certificate->donation_history->donor_id != $donor->id) {
        $this->Flash->error('You are not allowed to view this certificate.');
        return $this->redirect(['action' => 'certificates']);
    }

    $this->set(compact(
        'certificate',
        'donor'
    ));
}
}