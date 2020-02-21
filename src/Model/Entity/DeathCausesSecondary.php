<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DeathCausesSecondary Entity
 *
 * @property int $id
 * @property string|null $name_fr
 * @property string|null $name_en
 * @property int $deces_principal_id
 *
 * @property \App\Model\Entity\DeathCausesPrimary $death_causes_primary
 */
class DeathCausesSecondary extends Entity
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
        'name_fr' => true,
        'name_en' => true,
        'deces_principal_id' => true,
        'death_causes_primary' => true,
    ];
}
