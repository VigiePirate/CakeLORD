<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Operators Model
 *
 * @property \App\Model\Table\CompatibilitiesTable&\Cake\ORM\Association\HasMany $Compatibilities
 *
 * @method \App\Model\Entity\Operator newEmptyEntity()
 * @method \App\Model\Entity\Operator newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Operator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Operator get($primaryKey, $options = [])
 * @method \App\Model\Entity\Operator findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Operator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Operator[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Operator|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Operator saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Operator[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Operator[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Operator[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Operator[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OperatorsTable extends Table
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

        $this->setTable('operators');
        $this->setDisplayField('symbol');
        $this->setPrimaryKey('id');

        $this->hasMany('Compatibilities', [
            'foreignKey' => 'operator_id',
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
            ->scalar('symbol')
            ->maxLength('symbol', 2)
            ->requirePresence('symbol', 'create')
            ->notEmptyString('symbol');

        $validator
            ->scalar('meaning')
            ->maxLength('meaning', 255)
            ->requirePresence('meaning', 'create')
            ->notEmptyString('meaning');

        return $validator;
    }
}
