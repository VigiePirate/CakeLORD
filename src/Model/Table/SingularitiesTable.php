<?php
// src/Model/Table/SingularitiesTable.php
namespace App\Model\Table;

use Cake\Validation\Validator;
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

    public function validationDefault(Validator $validator): Validator
    {
    $validator
        ->allowEmptyString('name_fr', false)
        ->minLength('name_fr', 1)
        ->maxLength('name_fr', 255)

        ->allowEmptyString('picture', false)
        ->minLength('picture', 1);

    return $validator;
    }
}
