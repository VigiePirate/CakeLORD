<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BackofficeRatteryMessage Entity
 *
 * @property int $id
 * @property int $rattery_id
 * @property int|null $staff_id
 * @property string|null $staff_comments
 * @property string|null $owner_comments
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\User $user
 */
class BackofficeRatteryMessage extends Entity
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
        'rattery_id' => true,
        'staff_id' => true,
        'staff_comments' => true,
        'owner_comments' => true,
        'created' => true,
        'modified' => true,
        'rattery' => true,
        'user' => true,
    ];
}
