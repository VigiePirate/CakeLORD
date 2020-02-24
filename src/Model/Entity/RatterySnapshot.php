<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RatterySnapshot Entity
 *
 * @property int $id
 * @property string $data
 * @property \Cake\I18n\FrozenTime $created
 * @property int $rattery_id
 * @property int $state_id
 *
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\State $state
 */
class RatterySnapshot extends Entity
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
        'data' => true,
        'created' => true,
        'rattery_id' => true,
        'state_id' => true,
        'rattery' => true,
        'state' => true,
    ];
}
