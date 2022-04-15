<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\StatisticsTrait;

/**
 * State Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $color
 * @property string $symbol
 * @property string|null $css_property
 * @property bool $is_default
 * @property bool $needs_user_action
 * @property bool $needs_staff_action
 * @property bool $is_reliable
 * @property bool $is_visible
 * @property bool $is_searchable
 * @property bool $is_frozen
 * @property int|null $next_ok_state_id
 * @property int|null $next_ko_state_id
 * @property int|null $next_frozen_state_id
 * @property int|null $next_thawed_state_id
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
        'color' => true,
        'symbol' => true,
        'css_property' => true,
        'is_default' => true,
        'needs_user_action' => true,
        'needs_staff_action' => true,
        'is_reliable' => true,
        'is_visible' => true,
        'is_searchable' => true,
        'is_frozen' => true,
        'next_ok_state_id' => true,
        'next_ko_state_id' => true,
        'next_frozen_state_id' => true,
        'next_thawed_state_id' => true,
        'litter_snapshots' => true,
        'litters' => true,
        'rat_snapshots' => true,
        'rats' => true,
        'ratteries' => true,
        'rattery_snapshots' => true,
    ];
}
