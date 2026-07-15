<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Donor Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $blood_type_id
 * @property string $full_name
 * @property string $ic_number
 * @property string $phone_number
 * @property string $gender
 * @property \Cake\I18n\Date $date_of_birth
 * @property string $address
 * @property \Cake\I18n\Date|null $last_donation
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BloodType $blood_type
 * @property \App\Model\Entity\Appointment[] $appointments
 * @property \App\Model\Entity\DonationHistory[] $donation_histories
 */
class Donor extends Entity
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
        'user_id' => true,
        'blood_type_id' => true,
        'full_name' => true,
        'ic_number' => true,
        'phone_number' => true,
        'gender' => true,
        'date_of_birth' => true,
        'address' => true,
        'last_donation' => true,
        'user' => true,
        'blood_type' => true,
        'appointments' => true,
        'donation_histories' => true,
    ];
}
