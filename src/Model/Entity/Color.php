<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Color Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $genotype
 * @property string $picture
 * @property int|null $eyecolor_id
 *
 * @property \App\Model\Entity\Eyecolor $eyecolor
 * @property \App\Model\Entity\BackofficeRatEntry[] $backoffice_rat_entries
 * @property \App\Model\Entity\Rat[] $rats
 */
class Color extends Entity
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
        'genotype' => true,
        'picture' => true,
        'eyecolor_id' => true,
        'eyecolor' => true,
        'backoffice_rat_entries' => true,
        'rats' => true,
    ];
}
