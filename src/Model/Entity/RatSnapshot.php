<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RatSnapshot Entity
 *
 * @property int $id
 * @property string $data
 * @property int $rat_id
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Rat $rat
 * @property \App\Model\Entity\State $state
 */
class RatSnapshot extends Entity
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
        'rat_id' => true,
        'state_id' => true,
        'created' => true,
        'rat' => true,
        'state' => true,
    ];
}
