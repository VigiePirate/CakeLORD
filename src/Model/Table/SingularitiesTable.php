<?php
// src/Model/Table/SingularitiesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;


class SingularitiesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function beforeSave($event, $entity, $options)
{
    if ($entity->isNew() && !$entity->name_en) {
        $sluggedName = Text::slug($entity->name_fr);
        // trim slug to maximum length defined in schema
        $entity->name_en = substr($sluggedName, 0, 255);
    }
}
}
