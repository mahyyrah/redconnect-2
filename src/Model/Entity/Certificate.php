<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Certificate Entity
 *
 * @property int $id
 * @property int $donation_history_id
 * @property string $certificate_code
 * @property \Cake\I18n\DateTime $issued_at
 *
 * @property \App\Model\Entity\DonationHistory $donation_history
 */
class Certificate extends Entity
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
        'donation_history_id' => true,
        'certificate_code' => true,
        'issued_at' => true,
        'donation_history' => true,
    ];
}
