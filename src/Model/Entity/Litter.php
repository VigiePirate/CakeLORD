<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Litter Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $mating_date
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property int $pups_number
 * @property int|null $pups_number_stillborn
 * @property string|null $comments
 * @property int $creator_user_id
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\LitterSnapshot[] $litter_snapshots
 * @property \App\Model\Entity\Rat[] $parent_rats
 * @property \App\Model\Entity\Rattery[] $ratteries
 */
class Litter extends Entity
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
        'mating_date' => true,
        'birth_date' => true,
        'pups_number' => true,
        'pups_number_stillborn' => true,
        'comments' => true,
        'creator_user_id' => true,
        'state_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'state' => true,
        'conversations' => true,
        'litter_snapshots' => true,
        'parent_rats' => true,
        'ratteries' => true,
    ];

    protected function _getFullName()
    {
        $fullname = $this->birth_date->i18nFormat('dd/MM/yyyy') . ' – ' . $this->dam[0]->usual_name;
        if (isset ($this->sire[0])) {
            $fullname .= ' × ' . $this->sire[0]->usual_name;
        }
        return $fullname;
    }

    protected function _getNameFromSire()
    {
        $partname = $this->birth_date->i18nFormat('dd/MM/yyyy') . ' – ' . $this->pups_number . ' pups';
        if (isset ($this->dam[0]) && $this->dam[0]['name'] != 'Mère inconnue') {
            $partname .= ' with ' . $this->dam[0]->usual_name;
        } else {
            $partname .= ' with unknown mother';
        }
        return $partname;
    }

    protected function _getNameFromDam()
    {
        $partname = $this->birth_date->i18nFormat('dd/MM/yyyy') . ' – ' . $this->pups_number . ' pups';
        if (isset ($this->sire[0]) && $this->sire[0]['name'] != 'Père inconnu') {
            $partname .= ' with ' . $this->sire[0]->usual_name;
        } else {
            $partname .= ' with unknown father';
        }
        return $partname;
    }

    protected function _getSireAge() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInMonths($this->sire[0]->birth_date, true) .' months';
        } else { // should raise exception
            return __('Unknown');
            //return (1 + $agedate->diffInMonths($this->sire[0]->birth_date, true)) . ' months (estimated)';
        }
    }

    protected function _getDamAge() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInMonths($this->dam[0]->birth_date, true) .' months';
        } else { // should raise exception
            return __('Unknown');
            //return (1 + $agedate->diffInMonths($this->sire[0]->birth_date, true)) . ' months (estimated)';
        }
    }

    protected function _getInbreedingCoefficient()
    {

    }
}
