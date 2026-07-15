<?php
declare(strict_types=1);

namespace App\Controller;

class DonationHistoriesController extends AppController
{
    public function index()
    {
        $query = $this->DonationHistories->find()
            ->contain(['Donors', 'Staffs', 'Appointments']);

        $donationHistories = $this->paginate($query);

        $this->set(compact('donationHistories'));
    }

    public function view($id = null)
    {
        $donationHistory = $this->DonationHistories->get($id, contain: [
            'Donors',
            'Staffs',
            'Appointments',
            'Certificates'
        ]);

        $this->set(compact('donationHistory'));
    }

    public function add()
    {
        $donationHistory = $this->DonationHistories->newEmptyEntity();

        if ($this->request->is('post')) {
            $donationHistory = $this->DonationHistories->patchEntity(
                $donationHistory,
                $this->request->getData()
            );

            if ($this->DonationHistories->save($donationHistory)) {

                if (!empty($donationHistory->appointment_id)) {
                    $appointmentsTable = $this->fetchTable('Appointments');
                    $appointment = $appointmentsTable->get($donationHistory->appointment_id);
                    $appointment->status = 'completed';
                    $appointmentsTable->save($appointment);
                }

                $donorsTable = $this->fetchTable('Donors');
                $donor = $donorsTable->get($donationHistory->donor_id);
                $donor->last_donation = $donationHistory->donation_date;
                $donorsTable->save($donor);

                $certificatesTable = $this->fetchTable('Certificates');

                $existingCertificate = $certificatesTable->find()
                    ->where(['donation_history_id' => $donationHistory->id])
                    ->first();

                if (!$existingCertificate) {
                    $latest = $certificatesTable->find()
                        ->order(['Certificates.id' => 'DESC'])
                        ->first();

                    $nextNumber = $latest ? $latest->id + 1 : 1;

                    $certificateCode =
                        'RC-' .
                        date('Ymd') .
                        '-' .
                        str_pad((string)$nextNumber, 4, '0', STR_PAD_LEFT);

                    $certificate = $certificatesTable->newEmptyEntity();
                    $certificate->donation_history_id = $donationHistory->id;
                    $certificate->certificate_code = $certificateCode;

                    $certificatesTable->save($certificate);
                }

                $this->Flash->success(__('Donation history saved and certificate generated.'));

                return $this->redirect([
                    'controller' => 'Certificates',
                    'action' => 'index'
                ]);
            }

            $this->Flash->error(__('The donation history could not be saved. Please, try again.'));
        }

        $donors = $this->DonationHistories->Donors->find('list', limit: 200)->all();
        $staffs = $this->DonationHistories->Staffs->find('list', limit: 200)->all();
        $appointments = $this->DonationHistories->Appointments->find('list', limit: 200)->all();

        $this->set(compact('donationHistory', 'donors', 'staffs', 'appointments'));
    }

    public function edit($id = null)
    {
        $donationHistory = $this->DonationHistories->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $donationHistory = $this->DonationHistories->patchEntity(
                $donationHistory,
                $this->request->getData()
            );

            if ($this->DonationHistories->save($donationHistory)) {
                $this->Flash->success(__('The donation history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The donation history could not be saved. Please, try again.'));
        }

        $donors = $this->DonationHistories->Donors->find('list', limit: 200)->all();
        $staffs = $this->DonationHistories->Staffs->find('list', limit: 200)->all();
        $appointments = $this->DonationHistories->Appointments->find('list', limit: 200)->all();

        $this->set(compact('donationHistory', 'donors', 'staffs', 'appointments'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $donationHistory = $this->DonationHistories->get($id);

        if ($this->DonationHistories->delete($donationHistory)) {
            $this->Flash->success(__('The donation history has been deleted.'));
        } else {
            $this->Flash->error(__('The donation history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}