<?php
// src/Model/Table/SingularitiesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class SingularitiesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
}
