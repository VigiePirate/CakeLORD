<?php
declare(strict_types=1);

namespace App\Model\Entity;
use App\Model\Entity\StatisticsTrait;

use Cake\ORM\Entity;

/**
 * DeathPrimaryCause Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property bool $is_infant
 * @property bool $is_accident
 * @property bool $is_oldster
 *
 * @property \App\Model\Entity\DeathSecondaryCause[] $death_secondary_causes
 * @property \App\Model\Entity\Rat[] $rats
 */
class DeathPrimaryCause extends Entity
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
        'description' => true,
        'is_infant' => true,
        'is_accident' => true,
        'is_oldster' => true,
        'death_secondary_causes' => true,
        'rats' => true,
    ];
}
