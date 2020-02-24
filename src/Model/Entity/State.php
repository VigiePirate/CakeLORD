<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * State Entity
 *
 * @property int $id
 * @property string $name
 * @property string $color
 *
 * @property \App\Model\Entity\LitterSnapshot[] $litter_snapshots
 * @property \App\Model\Entity\Litter[] $litters
 * @property \App\Model\Entity\RatSnapshot[] $rat_snapshots
 * @property \App\Model\Entity\Rat[] $rats
 * @property \App\Model\Entity\Rattery[] $ratteries
 * @property \App\Model\Entity\RatterySnapshot[] $rattery_snapshots
 */
class State extends Entity
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
        'color' => true,
        'litter_snapshots' => true,
        'litters' => true,
        'rat_snapshots' => true,
        'rats' => true,
        'ratteries' => true,
        'rattery_snapshots' => true,
    ];
}
