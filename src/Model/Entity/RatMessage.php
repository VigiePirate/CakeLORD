<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RatMessage Entity
 *
 * @property int $id
 * @property int $rat_id
 * @property int $from_user_id
 * @property string $content
 * @property \Cake\I18n\FrozenTime $created
 * @property bool $is_staff_request
 * @property bool $is_automatically_generated
 *
 * @property \App\Model\Entity\Rat $rat
 * @property \App\Model\Entity\User $user
 */
class RatMessage extends Entity
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
        'rat_id' => true,
        'from_user_id' => true,
        'content' => true,
        'created' => true,
        'is_staff_request' => true,
        'is_automatically_generated' => true,
        'rat' => true,
        'user' => true,
    ];
}
