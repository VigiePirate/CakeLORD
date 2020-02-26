<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rattery Entity
 *
 * @property int $id
 * @property string $prefix
 * @property string $name
 * @property int $owner_user_id
 * @property string|null $birth_year
 * @property bool $is_alive
 * @property string|null $district
 * @property string|null $zip_code
 * @property int $country_id
 * @property string|null $website
 * @property string|null $comments
 * @property string $picture
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\Litter[] $litters
 * @property \App\Model\Entity\Rat[] $rats
 * @property \App\Model\Entity\Rat[] $m_children_rats
 * @property \App\Model\Entity\Rat[] $f_children_rats
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
        'prefix' => true,
        'name' => true,
        'owner_user_id' => true,
        'birth_year' => true,
        'is_alive' => true,
        'district' => true,
        'zip_code' => true,
        'country_id' => true,
        'website' => true,
        'comments' => true,
        'picture' => true,
        'state_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'state' => true,
        'country' => true,
        'conversations' => true,
        'litters' => true,
        'rats' => true,
        'm_children_rats' => true,
        'f_children_rats' => true,
        'rattery_snapshots' => true,
    ];
}
