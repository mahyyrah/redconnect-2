<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CertificatesFixture
 */
class CertificatesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'donation_history_id' => 1,
                'certificate_code' => 'Lorem ipsum dolor sit amet',
                'issued_at' => 1783094855,
            ],
        ];
        parent::init();
    }
}
