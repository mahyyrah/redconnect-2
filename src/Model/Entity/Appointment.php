<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appointment Entity
 *
 * @property int $id
 * @property int $donor_id
 * @property \Cake\I18n\Date $appointment_date
 * @property \Cake\I18n\Time $appointment_time
 * @property string $health_declaration
 * @property string $status
 *
 * @property \App\Model\Entity\Donor $donor
 * @property \App\Model\Entity\DonationHistory[] $donation_histories
 */
class Appointment extends Entity
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
        'appointment_date' => true,
        'appointment_time' => true,
        'health_declaration' => true,
        'status' => true,
        'donor' => true,
        'donation_histories' => true,
    ];
}
