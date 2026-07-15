<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Appointments Controller
 *
 * @property \App\Model\Table\AppointmentsTable $Appointments
 */
class AppointmentsController extends AppController
{
    public function index()
    {
        $query = $this->Appointments->find()
            ->contain(['Donors']);

        $appointments = $this->paginate($query);

        $this->set(compact('appointments'));
    }

    public function view($id = null)
    {
        $appointment = $this->Appointments->get($id, contain: ['Donors', 'DonationHistories']);

        $this->set(compact('appointment'));
    }

    public function add()
    {
        $appointment = $this->Appointments->newEmptyEntity();

        if ($this->request->is('post')) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());

            // Auto set appointment status
            $appointment->status = 'pending';

            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved and is now pending approval.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
        }

        $donors = $this->Appointments->Donors->find('list', limit: 200)->all();

        $this->set(compact('appointment', 'donors'));
    }

    public function edit($id = null)
    {
        $appointment = $this->Appointments->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());

            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
        }

        $donors = $this->Appointments->Donors->find('list', limit: 200)->all();

        $this->set(compact('appointment', 'donors'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $appointment = $this->Appointments->get($id);

        if ($this->Appointments->delete($appointment)) {
            $this->Flash->success(__('The appointment has been deleted.'));
        } else {
            $this->Flash->error(__('The appointment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}