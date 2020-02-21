<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Litter Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $date_mating
 * @property \Cake\I18n\FrozenDate|null $date_birth
 * @property int|null $number_pups
 * @property int|null $number_pups_stillborn
 * @property string|null $comments
 * @property int $rat_mother_id
 * @property int|null $rat_father_id
 * @property int $owner_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Rat[] $rats
 * @property \App\Model\Entity\User $user
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
        'date_mating' => true,
        'date_birth' => true,
        'number_pups' => true,
        'number_pups_stillborn' => true,
        'comments' => true,
        'rat_mother_id' => true,
        'rat_father_id' => true,
        'owner_id' => true,
        'created' => true,
        'modified' => true,
        'rats' => true,
        'user' => true,
    ];
}
