<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DonorsFixture
 */
class DonorsFixture extends TestFixture
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
                'user_id' => 1,
                'blood_type_id' => 1,
                'full_name' => 'Lorem ipsum dolor sit amet',
                'ic_number' => 'Lorem ipsu',
                'phone_number' => 'Lorem ipsum dolor ',
                'gender' => 'Lorem ip',
                'date_of_birth' => '2026-07-03',
                'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'last_donation' => '2026-07-03',
            ],
        ];
        parent::init();
    }
}
