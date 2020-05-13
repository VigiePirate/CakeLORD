<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
use Cake\Collection\Collection;
use Cake\View\Helper\HtmlHelper;

/**
 * Rat Entity
 *
 * @property int $id
 * @property string|null $pedigree_identifier
 * @property bool $is_pedigree_custom
 * @property int|null $owner_user_id
 * @property string $name
 * @property string|null $pup_name
 * @property string $sex
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property int $rattery_id
 * @property int $litter_id
 * @property int $color_id
 * @property int $eyecolor_id
 * @property int $dilution_id
 * @property int $marking_id
 * @property int $earset_id
 * @property int $coat_id
 * @property bool $is_alive
 * @property \Cake\I18n\FrozenDate|null $death_date
 * @property int|null $death_primary_cause_id
 * @property int|null $death_secondary_cause_id
 * @property bool|null $death_euthanized
 * @property bool|null $death_diagnosed
 * @property bool|null $death_necropsied
 * @property string|null $comments
 * @property string|null $picture
 * @property string|null $picture_thumbnail
 * @property int $creator_user_id
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $owner_user
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\Color $color
 * @property \App\Model\Entity\Eyecolor $eyecolor
 * @property \App\Model\Entity\Dilution $dilution
 * @property \App\Model\Entity\Marking $marking
 * @property \App\Model\Entity\Earset $earset
 * @property \App\Model\Entity\Coat $coat
 * @property \App\Model\Entity\DeathPrimaryCause $death_primary_cause
 * @property \App\Model\Entity\DeathSecondaryCause $death_secondary_cause
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\RatSnapshot[] $rat_snapshots
 * @property \App\Model\Entity\Litter[] $litters
 * @property \App\Model\Entity\Singularity[] $singularities
 */
class Rat extends Entity
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
        'pedigree_identifier' => true,
        'is_pedigree_custom' => true,
        'owner_user_id' => true,
        'name' => true,
        'pup_name' => true,
        'sex' => true,
        'birth_date' => true,
        'rattery_id' => true,
        'litter_id' => true,
        'color_id' => true,
        'eyecolor_id' => true,
        'dilution_id' => true,
        'marking_id' => true,
        'earset_id' => true,
        'coat_id' => true,
        'is_alive' => true,
        'death_date' => true,
        'death_primary_cause_id' => true,
        'death_secondary_cause_id' => true,
        'death_euthanized' => true,
        'death_diagnosed' => true,
        'death_necropsied' => true,
        'comments' => true,
        'picture' => true,
        'picture_thumbnail' => true,
        'creator_user_id' => true,
        'state_id' => true,
        'created' => true,
        'modified' => true,
        'owner_user' => true,
        'rattery' => true,
        'color' => true,
        'eyecolor' => true,
        'dilution' => true,
        'marking' => true,
        'earset' => true,
        'coat' => true,
        'death_primary_cause' => true,
        'death_secondary_cause' => true,
        'creator_user' => true,
        'state' => true,
        'conversations' => true,
        'rat_snapshots' => true,
        'litters' => true,
        'singularities' => true,
    ];

     protected function _getFullName()
     {
         return $this->pedigree_identifier . ' ' . $this->name . $this->is_alive_symbol;
     }

     protected function _getUsualName()
     {
         return $this->rattery->prefix . ' ' . $this->name;
     }

     protected function _getIsAliveSymbol()
     {
         // dagger is preceded with a non breakable fine space, do not edit!
         return (!$this->is_alive ? ' †' : '');
     }

     protected function _getSexName()
     {
         return $this->sex=='M' ? 'Male' : 'Female';
     }

     protected function _getSexSymbol()
     {
         return $this->sex=='M' ? '♂' : '♀';
     }

     protected function _getPictureThumbnail()
     {
         if (isset($this->_fields['picture_thumbnails'])) {
             return $this->_fields['picture_thumbnails'];
         } else {
             return 'thumbnails/Unknown.png';
         }
     }

     protected function _getPedigreeIdentifier()
     {
         if ($this->is_pedigree_custom || isset($this->_fields['pedigree_identifier'])) {
             return $this->_fields['pedigree_identifier'];
         } else if (isset ($this->rattery)) {
             return $this->rattery->prefix . $this->id . $this->sex ;
         } else {
             return '???';
         }
     }

     protected function _setPedigreeIdentifier($pedigree_identifier)
     {
         if ($this->is_pedigree_custom) {
             return $pedigree_identifier ;
         } else if (isset($this->_fields['id']) && isset($this->rattery)) {
             return $this->rattery->prefix . $this->id . $this->sex ;
         } else {
             return '' ;
         }
     }

     protected function _getAge()
     {
         $agedate = FrozenTime::now();
         if (! $this->_fields['is_alive'] && isset($this->_fields['death_date'])) {
             $agedate = $this->_fields['death_date'];
         }
         if (isset($this->birth_date)) {
             return $agedate->diffInMonths($this->_fields['birth_date'], true);
         } else {
             return 0; // Should raise exception
         }
     }

     protected function _getAgeString()
     {
         $age = $this->age . ' months';
         if (! $this->age) {
             $age .= ' (birth date unknown)'; // Should raise exception
         }
         if (! $this->_fields['is_alive']) {
             isset($this->_fields['death_date']) ? $age = 'deceased at ' . $age : $age = 'supposed deceased at ' . $age;
         }
         return $age;
     }

     protected function _getSingularityString()
     {
         if (isset($this->_fields['singularity_string'])) {
             return $this->_fields['singularity_string'];
         }
         if (empty($this->singularities)) {
             return '';
         }
         $singularities = new Collection($this->singularities);
         $str = $singularities->reduce(function ($string, $singularity) {
             return $string . $singularity->name . ', ';
             // this might be improved through a cell, to add links on singularity lists ; the following does not work at the moment
             // return $string . $this->Html->link($singularity->name, ['controller' => 'Singularities', 'action' => 'view', $singularity->id]) . ', ';
         }, '');
         return trim($str, ', ');
     }

}
