<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BackofficeRatEntriesSingularity Entity
 *
 * @property int $backoffice_rat_entries_id
 * @property int $singularities_id
 *
 * @property \App\Model\Entity\BackofficeRatEntry $backoffice_rat_entry
 * @property \App\Model\Entity\Singularity $singularity
 */
class BackofficeRatEntriesSingularity extends Entity
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
        'backoffice_rat_entry' => true,
        'singularity' => true,
    ];
}
