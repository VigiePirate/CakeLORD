<?php
declare(strict_types=1);

namespace App\Model\Entity;
use App\Model\Entity\StatisticsTrait;

use Cake\ORM\Entity;

/**
 * DeathSecondaryCause Entity
 *
 * @property int $id
 * @property string $name
 * @property int $death_primary_cause_id
 * @property string $description
 * @property bool $is_tumor
 *
 * @property \App\Model\Entity\DeathPrimaryCause $death_primary_cause
 * @property \App\Model\Entity\Rat[] $rats
 */
class DeathSecondaryCause extends Entity
{
    use StatisticsTrait;
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
        'death_primary_cause_id' => true,
        'description' => true,
        'is_tumor' => true,
        'death_primary_cause' => true,
        'rats' => true,
    ];
}
