<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Incompatibilities Model
 *
 * @method \App\Model\Entity\Incompatibility newEmptyEntity()
 * @method \App\Model\Entity\Incompatibility newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Incompatibility[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Incompatibility get($primaryKey, $options = [])
 * @method \App\Model\Entity\Incompatibility findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Incompatibility patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Incompatibility[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Incompatibility|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Incompatibility saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Incompatibility[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incompatibility[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incompatibility[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incompatibility[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class IncompatibilitiesTable extends Table
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

        $this->setTable('incompatibilities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('genotype1')
            ->maxLength('genotype1', 70)
            ->requirePresence('genotype1', 'create')
            ->notEmptyString('genotype1');

        $validator
            ->scalar('genotype2')
            ->maxLength('genotype2', 70)
            ->requirePresence('genotype2', 'create')
            ->notEmptyString('genotype2');

        $validator
            ->scalar('comments')
            ->requirePresence('comments', 'create')
            ->notEmptyString('comments');

        return $validator;
    }
}
