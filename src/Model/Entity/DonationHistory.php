<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DonationHistory Entity
 *
 * @property int $id
 * @property int $donor_id
 * @property int $staff_id
 * @property int|null $appointment_id
 * @property \Cake\I18n\Date $donation_date
 * @property int $quantity_pack
 * @property string|null $remarks
 *
 * @property \App\Model\Entity\Donor $donor
 * @property \App\Model\Entity\Staff $staff
 * @property \App\Model\Entity\Appointment $appointment
 * @property \App\Model\Entity\Certificate $certificate
 */
class DonationHistory extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'donor_id' => true,
        'staff_id' => true,
        'appointment_id' => true,
        'donation_date' => true,
        'quantity_pack' => true,
        'remarks' => true,
        'donor' => true,
        'staff' => true,
        'appointment' => true,
        'certificate' => true,
    ];
}
