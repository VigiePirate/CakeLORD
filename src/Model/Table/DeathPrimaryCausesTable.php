<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeathPrimaryCauses Model
 *
 * @property \App\Model\Table\DeathSecondaryCausesTable&\Cake\ORM\Association\HasMany $DeathSecondaryCauses
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 *
 * @method \App\Model\Entity\DeathPrimaryCause get($primaryKey, $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause findOrCreate($search, callable $callback = null, $options = [])
 */
class DeathPrimaryCausesTable extends Table
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

        $this->setTable('death_primary_causes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('DeathSecondaryCauses', [
            'foreignKey' => 'death_primary_cause_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'death_primary_cause_id',
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
