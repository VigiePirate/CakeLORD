<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contributions Model
 *
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsTo $Ratteries
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsTo $Litters
 * @property \App\Model\Table\ContributionTypesTable&\Cake\ORM\Association\BelongsTo $ContributionTypes
 *
 * @method \App\Model\Entity\Contribution newEmptyEntity()
 * @method \App\Model\Entity\Contribution newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Contribution[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contribution get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contribution findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Contribution patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contribution[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contribution|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contribution saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contribution[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contribution[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contribution[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contribution[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ContributionsTable extends Table
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

        $this->setTable('contributions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ratteries', [
            'foreignKey' => 'rattery_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Litters', [
            'foreignKey' => 'litter_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ContributionTypes', [
            'foreignKey' => 'contribution_type_id',
            'joinType' => 'INNER',
            'finder' => 'Ordered',
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
        $rules->add($rules->existsIn(['rattery_id'], 'Ratteries'));
        $rules->add($rules->existsIn(['litter_id'], 'Litters'));
        $rules->add($rules->existsIn(['contribution_type_id'], 'ContributionTypes'));

        return $rules;
    }

    public function findOrdered(Query $query, array $options)
    {
        return $query
            ->contain(['ContributionTypes', 'Ratteries'])
            ->order(['ContributionTypes.priority' => 'ASC']);
    }

    public function findFromRattery(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['ratteries'])) {
            $query->leftJoinWith('Ratteries')
                  ->where([
                      'OR' => ['Ratteries.name IS' => null, 'Ratteries.prefix IS' => NULL],
                  ]);
        } else {
            // Find articles that have one or more of the provided tags.
            $query->innerJoinWith('Ratteries')
                  ->where(['Ratteries.id' => implode($options['ratteries'])]);
        }

        return $query->group(['Contributions.id']);
    }

    public function findFromLitterAndType(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        $query->where([
            'litter_id' => implode($options['litter_id']),
            'contribution_type_id' => implode($options['contribution_type_id'])
        ]);
        return $query->group(['Contributions.id']);
    }
}
