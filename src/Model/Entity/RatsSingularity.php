<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RatsSingularity Entity
 *
 * @property int $rat_id
 * @property int $singularity_id
 *
 * @property \App\Model\Entity\Rat $rat
 * @property \App\Model\Entity\Singularity $singularity
 */
class RatsSingularity extends Entity
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
        'rat' => true,
        'singularity' => true,
    ];
}
