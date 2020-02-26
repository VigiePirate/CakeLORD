<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Compatibility Entity
 *
 * @property int $id
 * @property string $left_genotype
 * @property int $operator_id
 * @property string $right_genotype
 * @property string $comments
 *
 * @property \App\Model\Entity\Operator $operator
 */
class Compatibility extends Entity
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
        'left_genotype' => true,
        'operator_id' => true,
        'right_genotype' => true,
        'comments' => true,
        'operator' => true,
    ];
}
