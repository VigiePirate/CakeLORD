<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContributionTypes Model
 *
 * @property \App\Model\Table\ContributionsTable&\Cake\ORM\Association\HasMany $Contributions
 *
 * @method \App\Model\Entity\ContributionType newEmptyEntity()
 * @method \App\Model\Entity\ContributionType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ContributionType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContributionType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContributionType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ContributionType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContributionType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContributionType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContributionType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContributionType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContributionType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContributionType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ContributionType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ContributionTypesTable extends Table
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

        $this->setTable('contribution_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Contributions', [
            'foreignKey' => 'contribution_type_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('priority', 'create')
            ->notEmptyString('priority')
            ->add('priority', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['priority']));

        return $rules;
    }

    public function findOrdered(Query $query, array $options)
    {
        return $query
            ->order(['priority' => 'ASC']);
    }
}
