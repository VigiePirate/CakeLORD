<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Earsets Model
 *
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 *
 * @method \App\Model\Entity\Earset newEmptyEntity()
 * @method \App\Model\Entity\Earset newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Earset[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Earset get($primaryKey, $options = [])
 * @method \App\Model\Entity\Earset findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Earset patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Earset[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Earset|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Earset saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Earset[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Earset[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Earset[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Earset[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EarsetsTable extends Table
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

        $this->setTable('earsets');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Picture');
        $this->addBehavior('Translate', [
            'fields' => ['name', 'genotype', 'description'],
        ]);

        $this->hasMany('Rats', [
            'foreignKey' => 'earset_id',
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
            ->maxLength('name', 70)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->notEmptyString('picture');

        $validator
            ->scalar('genotype')
            ->maxLength('genotype', 70)
            ->requirePresence('genotype', 'create')
            ->notEmptyString('genotype');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->boolean('is_picture_mandatory')
            ->notEmptyString('is_picture_mandatory');

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
