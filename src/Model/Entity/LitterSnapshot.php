<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LitterSnapshot Entity
 *
 * @property int $id
 * @property string $data
 * @property \Cake\I18n\FrozenTime $created
 * @property int $litter_id
 * @property int $state_id
 *
 * @property \App\Model\Entity\Litter $litter
 * @property \App\Model\Entity\State $state
 */
class LitterSnapshot extends Entity
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
        'litter_id' => true,
        'state_id' => true,
        'litter' => true,
        'state' => true,
    ];
}
