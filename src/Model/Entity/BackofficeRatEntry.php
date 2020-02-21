<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BackofficeRatEntry Entity
 *
 * @property int $id
 * @property int|null $status
 * @property int|null $rat_id
 * @property string|null $rat_name_owner
 * @property string|null $rat_name_pup
 * @property string|null $rat_sex
 * @property string|null $rat_pedigree_identifier
 * @property \Cake\I18n\FrozenDate|null $rat_date_birth
 * @property \Cake\I18n\FrozenDate|null $rat_date_death
 * @property int|null $death_cause_primary_id
 * @property int|null $death_cause_secondary_id
 * @property bool|null $rat_death_euthanized
 * @property bool|null $rat_death_diagnosed
 * @property bool|null $rat_death_necropsied
 * @property string|null $rat_picture
 * @property string|null $rat_picture_thumbnail
 * @property string|null $rat_comments
 * @property int|null $rat_validated
 * @property int|null $rattery_mother_id
 * @property int|null $rattery_father_id
 * @property int|null $rat_mother_id
 * @property int|null $rat_father_id
 * @property int|null $user_owner_id
 * @property int|null $color_id
 * @property int|null $earset_id
 * @property int|null $eyecolor_id
 * @property int|null $dilution_id
 * @property int|null $coat_id
 * @property int|null $marking_id
 * @property string|null $singularity_id_list
 * @property int|null $user_creator_id
 * @property \Cake\I18n\FrozenDate|null $rat_date_create
 * @property \Cake\I18n\FrozenDate|null $rat_date_last_update
 *
 * @property \App\Model\Entity\Rat $rat
 * @property \App\Model\Entity\DeathCausesPrimary $death_causes_primary
 * @property \App\Model\Entity\DeathCausesSecondary $death_causes_secondary
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\BackofficeRatEntry $backoffice_rat_entry
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Color $color
 * @property \App\Model\Entity\Earset $earset
 * @property \App\Model\Entity\Eyecolor $eyecolor
 * @property \App\Model\Entity\Dilution $dilution
 * @property \App\Model\Entity\Coat $coat
 * @property \App\Model\Entity\Marking $marking
 * @property \App\Model\Entity\BackofficeRatMessage[] $backoffice_rat_messages
 */
class BackofficeRatEntry extends Entity
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
        'status' => true,
        'rat_id' => true,
        'rat_name_owner' => true,
        'rat_name_pup' => true,
        'rat_sex' => true,
        'rat_pedigree_identifier' => true,
        'rat_date_birth' => true,
        'rat_date_death' => true,
        'death_cause_primary_id' => true,
        'death_cause_secondary_id' => true,
        'rat_death_euthanized' => true,
        'rat_death_diagnosed' => true,
        'rat_death_necropsied' => true,
        'rat_picture' => true,
        'rat_picture_thumbnail' => true,
        'rat_comments' => true,
        'rat_validated' => true,
        'rattery_mother_id' => true,
        'rattery_father_id' => true,
        'rat_mother_id' => true,
        'rat_father_id' => true,
        'user_owner_id' => true,
        'color_id' => true,
        'earset_id' => true,
        'eyecolor_id' => true,
        'dilution_id' => true,
        'coat_id' => true,
        'marking_id' => true,
        'singularity_id_list' => true,
        'user_creator_id' => true,
        'rat_date_create' => true,
        'rat_date_last_update' => true,
        'rat' => true,
        'death_causes_primary' => true,
        'death_causes_secondary' => true,
        'rattery' => true,
        'backoffice_rat_entry' => true,
        'user' => true,
        'color' => true,
        'earset' => true,
        'eyecolor' => true,
        'dilution' => true,
        'coat' => true,
        'marking' => true,
        'backoffice_rat_messages' => true,
    ];
}
