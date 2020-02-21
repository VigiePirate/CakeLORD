<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Marking Entity
 *
 * @property int $id
 * @property string|null $name_fr
 * @property string|null $name_en
 * @property string|null $picture
 *
 * @property \App\Model\Entity\BackofficeRatEntry[] $backoffice_rat_entries
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
        'name_fr' => true,
        'name_en' => true,
        'picture' => true,
        'backoffice_rat_entries' => true,
        'rats' => true,
    ];
}
