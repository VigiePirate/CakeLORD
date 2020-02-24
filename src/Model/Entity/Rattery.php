<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rattery Entity
 *
 * @property int $id
 * @property string $name
 * @property string $prefix
 * @property int $owner_id
 * @property string|null $comments
 * @property string|null $picture
 * @property bool $is_alive
 * @property string|null $birth_year
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $state_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\Litter[] $litters
 * @property \App\Model\Entity\Rat[] $rats
 * @property \App\Model\Entity\RatterySnapshot[] $rattery_snapshots
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
        'is_alive' => true,
        'birth_year' => true,
        'created' => true,
        'modified' => true,
        'state_id' => true,
        'user' => true,
        'state' => true,
        'conversations' => true,
        'litters' => true,
        'rats' => true,
        'rattery_snapshots' => true,
    ];
}
