<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DonationHistoriesFixture
 */
class DonationHistoriesFixture extends TestFixture
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
                'donor_id' => 1,
                'staff_id' => 1,
                'appointment_id' => 1,
                'donation_date' => '2026-07-03',
                'quantity_pack' => 1,
                'remarks' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
