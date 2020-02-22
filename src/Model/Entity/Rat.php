<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rat Entity
 *
 * @property int $id
 * @property string|null $name_owner
 * @property string|null $name_pup
 * @property string $sex
 * @property string|null $pedigree_identifier
 * @property \Cake\I18n\FrozenDate|null $birth_date
 * @property \Cake\I18n\FrozenDate|null $death_date
 * @property int|null $death_primary_cause_id
 * @property int|null $death_secondary_cause_id
 * @property bool|null $death_euthanized
 * @property bool|null $death_diagnosed
 * @property bool|null $death_necropsied
 * @property string|null $picture
 * @property string|null $picture_thumbnail
 * @property string|null $comments
 * @property bool|null $validated
 * @property int|null $mother_rattery_id
 * @property int|null $father_rattery_id
 * @property int|null $mother_rat_id
 * @property int|null $father_rat_id
 * @property int|null $litter_id
 * @property int|null $owner_user_id
 * @property int|null $color_id
 * @property int|null $earset_id
 * @property int|null $eyecolor_id
 * @property int|null $dilution_id
 * @property int|null $coat_id
 * @property int|null $marking_id
 * @property int $creator_user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $state_id
 *
 * @property \App\Model\Entity\DeathCausesPrimary $death_causes_primary
 * @property \App\Model\Entity\DeathCausesSecondary $death_causes_secondary
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\Rat $rat
 * @property \App\Model\Entity\Litter $litter
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Color $color
 * @property \App\Model\Entity\Earset $earset
 * @property \App\Model\Entity\Eyecolor $eyecolor
 * @property \App\Model\Entity\Dilution $dilution
 * @property \App\Model\Entity\Coat $coat
 * @property \App\Model\Entity\Marking $marking
 * @property \App\Model\Entity\BackofficeRatEntry[] $backoffice_rat_entries
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
        'name_owner' => true,
        'name_pup' => true,
        'sex' => true,
        'pedigree_identifier' => true,
        'birth_date' => true,
        'death_date' => true,
        'death_primary_cause_id' => true,
        'death_secondary_cause_id' => true,
        'death_euthanized' => true,
        'death_diagnosed' => true,
        'death_necropsied' => true,
        'picture' => true,
        'picture_thumbnail' => true,
        'comments' => true,
        'validated' => true,
        'mother_rattery_id' => true,
        'father_rattery_id' => true,
        'mother_rat_id' => true,
        'father_rat_id' => true,
        'litter_id' => true,
        'owner_user_id' => true,
        'color_id' => true,
        'earset_id' => true,
        'eyecolor_id' => true,
        'dilution_id' => true,
        'coat_id' => true,
        'marking_id' => true,
        'creator_user_id' => true,
        'created' => true,
        'modified' => true,
        'state_id' => true,
        'death_causes_primary' => true,
        'death_causes_secondary' => true,
        'rattery' => true,
        'rat' => true,
        'litter' => true,
        'user' => true,
        'color' => true,
        'earset' => true,
        'eyecolor' => true,
        'dilution' => true,
        'coat' => true,
        'marking' => true,
        'backoffice_rat_entries' => true,
        'singularities' => true,
    ];
}
