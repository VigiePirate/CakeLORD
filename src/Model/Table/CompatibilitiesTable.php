<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Compatibilities Model
 *
 * @property \App\Model\Table\OperatorsTable&\Cake\ORM\Association\BelongsTo $Operators
 *
 * @method \App\Model\Entity\Compatibility newEmptyEntity()
 * @method \App\Model\Entity\Compatibility newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Compatibility[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Compatibility get($primaryKey, $options = [])
 * @method \App\Model\Entity\Compatibility findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Compatibility patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Compatibility[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Compatibility|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compatibility saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compatibility[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compatibility[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compatibility[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Compatibility[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CompatibilitiesTable extends Table
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

        $this->setTable('compatibilities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Operators', [
            'foreignKey' => 'operator_id',
            'joinType' => 'INNER',
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
            ->scalar('left_genotype')
            ->maxLength('left_genotype', 255)
            ->requirePresence('left_genotype', 'create')
            ->notEmptyString('left_genotype');

        $validator
            ->scalar('right_genotype')
            ->maxLength('right_genotype', 255)
            ->requirePresence('right_genotype', 'create')
            ->notEmptyString('right_genotype');

        $validator
            ->scalar('comments')
            ->requirePresence('comments', 'create')
            ->notEmptyString('comments');

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
        $rules->add($rules->existsIn(['operator_id'], 'Operators'));

        return $rules;
    }
}
