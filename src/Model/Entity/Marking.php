<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Marking Entity
 *
 * @property int $id
 * @property string $name
 * @property string $picture
 * @property string $genotype
 * @property string $description
 *
 * @property \App\Model\Entity\Rat[] $rats
 */
class Marking extends Entity
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
        'name' => true,
        'picture' => true,
        'genotype' => true,
        'description' => true,
        'rats' => true,
    ];
}
