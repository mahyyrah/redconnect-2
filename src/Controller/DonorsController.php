<?php
declare(strict_types=1);

namespace App\Controller;

class DonorsController extends AppController
{
    public function index()
    {
        $search = $this->request->getQuery('search');

        $query = $this->Donors->find()
            ->contain(['Users', 'BloodTypes']);

        if (!empty($search)) {
            $query->where([
                'OR' => [
                    'Donors.full_name LIKE' => '%' . $search . '%',
                    'Donors.ic_number LIKE' => '%' . $search . '%',
                    'Donors.phone_number LIKE' => '%' . $search . '%',
                    'BloodTypes.blood_group LIKE' => '%' . $search . '%',
                    'Users.email LIKE' => '%' . $search . '%',
                ]
            ]);
        }

        $donors = $this->paginate($query);

        $this->set(compact('donors', 'search'));
    }

    public function view($id = null)
    {
        $donor = $this->Donors->get($id, contain: ['Users', 'BloodTypes', 'Appointments', 'DonationHistories']);
        $this->set(compact('donor'));
    }

    public function add()
    {
        $donor = $this->Donors->newEmptyEntity();

        if ($this->request->is('post')) {
            $donor = $this->Donors->patchEntity($donor, $this->request->getData());

            if ($this->Donors->save($donor)) {
                $this->Flash->success(__('The donor has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The donor could not be saved. Please, try again.'));
        }

        $users = $this->Donors->Users->find('list', limit: 200)->all();
        $bloodTypes = $this->Donors->BloodTypes->find('list', limit: 200)->all();

        $this->set(compact('donor', 'users', 'bloodTypes'));
    }

    public function edit($id = null)
    {
        $donor = $this->Donors->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $donor = $this->Donors->patchEntity($donor, $this->request->getData());

            if ($this->Donors->save($donor)) {
                $this->Flash->success(__('The donor has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The donor could not be saved. Please, try again.'));
        }

        $users = $this->Donors->Users->find('list', limit: 200)->all();
        $bloodTypes = $this->Donors->BloodTypes->find('list', limit: 200)->all();

        $this->set(compact('donor', 'users', 'bloodTypes'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $donor = $this->Donors->get($id);

        if ($this->Donors->delete($donor)) {
            $this->Flash->success(__('The donor has been deleted.'));
        } else {
            $this->Flash->error(__('The donor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}