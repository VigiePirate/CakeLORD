<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Litter Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $mating_date
 * @property \Cake\I18n\FrozenDate|null $birth_date
 * @property int|null $pups_number
 * @property int|null $pups_number_stillborn
 * @property string|null $comments
 * @property int $mother_rat_id
 * @property int|null $father_rat_id
 * @property int $breeder_user_id
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
        'mating_date' => true,
        'birth_date' => true,
        'pups_number' => true,
        'pups_number_stillborn' => true,
        'comments' => true,
        'mother_rat_id' => true,
        'father_rat_id' => true,
        'breeder_user_id' => true,
        'created' => true,
        'modified' => true,
        'rats' => true,
        'user' => true,
    ];
}
