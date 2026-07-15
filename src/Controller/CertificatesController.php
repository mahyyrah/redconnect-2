<?php
declare(strict_types=1);

namespace App\Controller;

class CertificatesController extends AppController
{
    public function index()
    {
        $query = $this->Certificates
            ->find()
            ->contain([
                'DonationHistories' => [
                    'Donors' => [
                        'BloodTypes'
                    ],
                    'Staffs',
                    'Appointments'
                ]
            ])
            ->order([
                'Certificates.id' => 'DESC'
            ]);

        $certificates = $this->paginate($query);

        $this->set(compact('certificates'));
    }

    public function view($id = null)
    {
        $certificate = $this->Certificates->get($id, [
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

        $this->set(compact('certificate'));
    }

    public function add()
{
    die('THIS IS THE CONTROLLER');
        $certificate = $this->Certificates->newEmptyEntity();

        if ($this->request->is('post')) {
            $certificate = $this->Certificates->patchEntity(
                $certificate,
                $this->request->getData()
            );

            if (empty($certificate->donation_history_id)) {
                $this->Flash->error(
                    'Please select a completed donation.'
                );
            } else {
                $existingCertificate = $this->Certificates
                    ->find()
                    ->where([
                        'Certificates.donation_history_id' =>
                            $certificate->donation_history_id
                    ])
                    ->first();

                if ($existingCertificate) {
                    $this->Flash->error(
                        'A certificate has already been generated for this donation.'
                    );

                    return $this->redirect([
                        'action' => 'index'
                    ]);
                }

                $latestCertificate = $this->Certificates
                    ->find()
                    ->order([
                        'Certificates.id' => 'DESC'
                    ])
                    ->first();

                $nextNumber = $latestCertificate
                    ? ((int)$latestCertificate->id + 1)
                    : 1;

                $certificate->certificate_code =
                    'RC-' .
                    date('Ymd') .
                    '-' .
                    str_pad(
                        (string)$nextNumber,
                        4,
                        '0',
                        STR_PAD_LEFT
                    );

                $certificate->issued_at = date('Y-m-d H:i:s');

                if ($this->Certificates->save($certificate)) {
                    $this->Flash->success(
                        'The certificate has been generated successfully.'
                    );

                    return $this->redirect([
                        'action' => 'index'
                    ]);
                }

                $this->Flash->error(
                    'The certificate could not be generated. Please try again.'
                );
            }
        }

        $histories = $this->Certificates
            ->DonationHistories
            ->find()
            ->contain([
                'Donors' => [
                    'BloodTypes'
                ]
            ])
            ->order([
                'DonationHistories.donation_date' => 'DESC',
                'DonationHistories.id' => 'DESC'
            ])
            ->all();

        /*
         * TEMPORARY DEBUGGING
         *
         * This displays the donation histories retrieved by CakePHP
         * and stops the page before loading the form.
         */
        debug($histories->toArray());
        die;

        $donationHistories = [];

        foreach ($histories as $history) {
            $donorName =
                $history->donor->full_name
                ?? 'Unknown Donor';

            $bloodGroup =
                $history->donor->blood_type->blood_group
                ?? 'Unknown Blood Group';

            $donationDate = !empty($history->donation_date)
                ? (string)$history->donation_date
                : 'No Date';

            $donationHistories[$history->id] =
                $donorName .
                ' — ' .
                $bloodGroup .
                ' — ' .
                $donationDate;
        }

        $this->set(compact(
            'certificate',
            'donationHistories'
        ));
    }

    public function edit($id = null)
    {
        $certificate = $this->Certificates->get($id, [
            'contain' => [
                'DonationHistories'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $certificate = $this->Certificates->patchEntity(
                $certificate,
                $this->request->getData()
            );

            if ($this->Certificates->save($certificate)) {
                $this->Flash->success(
                    'The certificate has been updated successfully.'
                );

                return $this->redirect([
                    'action' => 'index'
                ]);
            }

            $this->Flash->error(
                'The certificate could not be updated. Please try again.'
            );
        }

        $histories = $this->Certificates
            ->DonationHistories
            ->find()
            ->contain([
                'Donors' => [
                    'BloodTypes'
                ]
            ])
            ->order([
                'DonationHistories.donation_date' => 'DESC',
                'DonationHistories.id' => 'DESC'
            ])
            ->all();

        $donationHistories = [];

        foreach ($histories as $history) {
            $donorName =
                $history->donor->full_name
                ?? 'Unknown Donor';

            $bloodGroup =
                $history->donor->blood_type->blood_group
                ?? 'Unknown Blood Group';

            $donationDate = !empty($history->donation_date)
                ? (string)$history->donation_date
                : 'No Date';

            $donationHistories[$history->id] =
                $donorName .
                ' — ' .
                $bloodGroup .
                ' — ' .
                $donationDate;
        }

        $this->set(compact(
            'certificate',
            'donationHistories'
        ));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);

        $certificate = $this->Certificates->get($id);

        if ($this->Certificates->delete($certificate)) {
            $this->Flash->success(
                'The certificate has been deleted.'
            );
        } else {
            $this->Flash->error(
                'The certificate could not be deleted. Please try again.'
            );
        }

        return $this->redirect([
            'action' => 'index'
        ]);
    }
}