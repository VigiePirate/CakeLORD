<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contribution Entity
 *
 * @property int $id
 * @property int $rattery_id
 * @property int $litter_id
 * @property int $contribution_type_id
 *
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\Litter $litter
 * @property \App\Model\Entity\ContributionType $contribution_type
 */
class Contribution extends Entity
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
        'rattery_id' => true,
        'litter_id' => true,
        'contribution_type_id' => true,
        'rattery' => true,
        'litter' => true,
        'contribution_type' => true,
    ];
}
