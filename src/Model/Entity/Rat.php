<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rat Entity
 *
 * @property int $id
 * @property string $pedigree_identifier
 * @property int|null $owner_user_id
 * @property string $name
 * @property string|null $pup_name
 * @property string $sex
 * @property \Cake\I18n\FrozenDate|null $birth_date
 * @property int $rattery_id
 * @property int|null $mother_rat_id
 * @property int|null $father_rat_id
 * @property int|null $litter_id
 * @property int|null $mother_rattery_id
 * @property int|null $father_rattery_id
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
 * @property \App\Model\Entity\DeathPrimaryCause $death_primary_cause
 * @property \App\Model\Entity\DeathSecondaryCause $death_secondary_cause
 * @property \App\Model\Entity\Rattery $mother_rattery
 * @property \App\Model\Entity\Rattery $father_rattery
 * @property \App\Model\Entity\Rat[] $m_children_rats
 * @property \App\Model\Entity\Rat $mother_rat
 * @property \App\Model\Entity\Rat[] $f_children_rats
 * @property \App\Model\Entity\Rat $father_rat
 * @property \App\Model\Entity\Litter $litter
 * @property \App\Model\Entity\User $owner_user
 * @property \App\Model\Entity\Color $color
 * @property \App\Model\Entity\Earset $earset
 * @property \App\Model\Entity\Eyecolor $eyecolor
 * @property \App\Model\Entity\Dilution $dilution
 * @property \App\Model\Entity\Coat $coat
 * @property \App\Model\Entity\Marking $marking
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\RatSnapshot[] $rat_snapshots
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
        'owner_user_id' => true,
        'name' => true,
        'pup_name' => true,
        'sex' => true,
        'birth_date' => true,
        'rattery_id' => true,
        'mother_rat_id' => true,
        'father_rat_id' => true,
        'litter_id' => true,
        'mother_rattery_id' => true,
        'father_rattery_id' => true,
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
        'death_primary_cause' => true,
        'death_secondary_cause' => true,
        'mother_rattery' => true,
        'father_rattery' => true,
        'm_children_rats' => true,
        'mother_rat' => true,
        'f_children_rats' => true,
        'father_rat' => true,
        'litter' => true,
        'owner_user' => true,
        'color' => true,
        'earset' => true,
        'eyecolor' => true,
        'dilution' => true,
        'coat' => true,
        'marking' => true,
        'user' => true,
        'state' => true,
        'rattery' => true,
        'conversations' => true,
        'rat_snapshots' => true,
        'singularities' => true,
    ];
}
