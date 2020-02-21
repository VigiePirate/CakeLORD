<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rattery Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $prefix
 * @property int $owner_id
 * @property string|null $comments
 * @property string|null $picture
 * @property bool|null $status
 * @property bool|null $validated
 * @property string|null $date_birth
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BackofficeRatteryMessage[] $backoffice_rattery_messages
 */
class Rattery extends Entity
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
        'prefix' => true,
        'owner_id' => true,
        'comments' => true,
        'picture' => true,
        'status' => true,
        'validated' => true,
        'date_birth' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'backoffice_rattery_messages' => true,
    ];
}
