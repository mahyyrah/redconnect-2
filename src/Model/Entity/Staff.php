<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $full_name
 * @property string $phone_number
 * @property string $position
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\DonationHistory[] $donation_histories
 */
class Staff extends Entity
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
        'full_name' => true,
        'phone_number' => true,
        'position' => true,
        'user' => true,
        'donation_histories' => true,
    ];
}
