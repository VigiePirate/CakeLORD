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
    if ($entity->isNew() && !$entity->id) {
        $sluggedTitle = Text::slug($entity->name_fr);
        // trim slug to maximum length defined in schema
        $entity->id = substr($sluggedTitle, 0, 191);
    }
}
}
