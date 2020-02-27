<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Conversation Entity
 *
 * @property int $id
 * @property int|null $rat_id
 * @property int|null $rattery_id
 * @property int|null $litter_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $is_active
 *
 * @property \App\Model\Entity\Rat $rat
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\Litter $litter
 * @property \App\Model\Entity\Message[] $messages
 * @property \App\Model\Entity\User[] $users
 */
class Conversation extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'rat_id' => true,
        'rattery_id' => true,
        'litter_id' => true,
        'created' => true,
        'modified' => true,
        'is_active' => true,
        'rat' => true,
        'rattery' => true,
        'litter' => true,
        'messages' => true,
        'users' => true,
    ];
}
