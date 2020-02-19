<?php
// src/Model/Entity/Singularity.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Singularity extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'name_fr' => false,
        'name_en' => false,
        'picture' => false,
    ];
}
