<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Issue Entity
 *
 * @property int $id
 * @property bool $is_open
 * @property string $url
 * @property string $complaint
 * @property string|null $handling
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $closed
 * @property int $from_user_id
 * @property int|null $closing_user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Issue extends Entity
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
    protected $_accessible = [
        'is_open' => true,
        'url' => true,
        'complaint' => true,
        'handling' => true,
        'created' => true,
        'closed' => true,
        'from_user_id' => true,
        'closing_user_id' => true,
        'user' => true,
    ];
}
