<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property string $name
 * @property bool $is_root
 * @property bool $is_admin
 * @property bool $is_staff
 * @property bool $can_change_state
 * @property bool $can_edit_others
 * @property bool $can_edit_frozen
 * @property bool $can_delete
 * @property bool $can_configure
 * @property bool $can_restore
 *
 * @property \App\Model\Entity\User[] $users
 */
class Role extends Entity
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
        'name' => true,
        'is_root' => true,
        'is_admin' => true,
        'is_staff' => true,
        'can_change_state' => true,
        'can_edit_others' => true,
        'can_edit_frozen' => true,
        'can_delete' => true,
        'can_configure' => true,
        'can_restore' => true,
        'users' => true,
    ];
}
