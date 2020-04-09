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
 * @property bool $is_generic
 * @property string|null $district
 * @property string|null $zip_code
 * @property int $country_id
 * @property string|null $website
 * @property string|null $comments
 * @property bool $wants_statistic
 * @property string $picture
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\Rat[] $rats
 * @property \App\Model\Entity\RatterySnapshot[] $rattery_snapshots
 * @property \App\Model\Entity\Litter[] $litters
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
        'is_generic' => true,
        'district' => true,
        'zip_code' => true,
        'country_id' => true,
        'website' => true,
        'comments' => true,
        'wants_statistic' => true,
        'picture' => true,
        'state_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'country' => true,
        'state' => true,
        'conversations' => true,
        'rats' => true,
        'rattery_snapshots' => true,
        'litters' => true,
    ];

    protected function _getFullName()
    {
        return $this->prefix . ' – ' . $this->name;
    }
}
