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
 * @property \Cake\I18n\FrozenDate|null $date_birth
 * @property \Cake\I18n\FrozenDate|null $date_death
 * @property int|null $death_cause_primary_id
 * @property int|null $death_cause_secondary_id
 * @property bool|null $death_euthanized
 * @property bool|null $death_diagnosed
 * @property bool|null $death_necropsied
 * @property string|null $picture
 * @property string|null $picture_thumbnail
 * @property string|null $comments
 * @property bool|null $validated
 * @property int|null $rattery_mother_id
 * @property int|null $rattery_father_id
 * @property int|null $mother_id
 * @property int|null $father_id
 * @property int|null $litter_id
 * @property int|null $owner_id
 * @property int|null $color_id
 * @property int|null $earset_id
 * @property int|null $eyecolor_id
 * @property int|null $dilution_id
 * @property int|null $coat_id
 * @property int|null $marking_id
 * @property int $user_creator_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
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
        'date_birth' => true,
        'date_death' => true,
        'death_cause_primary_id' => true,
        'death_cause_secondary_id' => true,
        'death_euthanized' => true,
        'death_diagnosed' => true,
        'death_necropsied' => true,
        'picture' => true,
        'picture_thumbnail' => true,
        'comments' => true,
        'validated' => true,
        'rattery_mother_id' => true,
        'rattery_father_id' => true,
        'mother_id' => true,
        'father_id' => true,
        'litter_id' => true,
        'owner_id' => true,
        'color_id' => true,
        'earset_id' => true,
        'eyecolor_id' => true,
        'dilution_id' => true,
        'coat_id' => true,
        'marking_id' => true,
        'user_creator_id' => true,
        'created' => true,
        'modified' => true,
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
