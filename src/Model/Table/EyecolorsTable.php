<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Eyecolors Model
 *
 * @property \App\Model\Table\ColorsTable&\Cake\ORM\Association\HasMany $Colors
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 *
 * @method \App\Model\Entity\Eyecolor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Eyecolor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Eyecolor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Eyecolor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eyecolor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eyecolor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Eyecolor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Eyecolor findOrCreate($search, callable $callback = null, $options = [])
 */
class EyecolorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('eyecolors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Colors', [
            'foreignKey' => 'eyecolor_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'eyecolor_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 70)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->notEmptyString('picture');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
