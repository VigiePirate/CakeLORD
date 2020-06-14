<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * States Model
 *
 * @property \App\Model\Table\LitterSnapshotsTable&\Cake\ORM\Association\HasMany $LitterSnapshots
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\HasMany $Litters
 * @property \App\Model\Table\RatSnapshotsTable&\Cake\ORM\Association\HasMany $RatSnapshots
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\HasMany $Ratteries
 * @property \App\Model\Table\RatterySnapshotsTable&\Cake\ORM\Association\HasMany $RatterySnapshots
 *
 * @method \App\Model\Entity\State newEmptyEntity()
 * @method \App\Model\Entity\State newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\State[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\State get($primaryKey, $options = [])
 * @method \App\Model\Entity\State findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\State patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\State[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\State|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\State saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class StatesTable extends Table
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

        $this->setTable('states');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('NextOkStates', [
            'className' => 'States',
            'foreignKey' => 'next_ok_state_id',
        ]);
        $this->belongsTo('NextKoStates', [
            'className' => 'States',
            'foreignKey' => 'next_ko_state_id',
        ]);
        $this->belongsTo('NextFrozenStates', [
            'className' => 'States',
            'foreignKey' => 'next_frozen_state_id',
        ]);
        $this->belongsTo('NextThawedStates', [
            'className' => 'States',
            'foreignKey' => 'next_thawed_state_id',
        ]);
        $this->hasMany('LitterSnapshots', [
            'foreignKey' => 'state_id',
        ]);
        $this->hasMany('Litters', [
            'foreignKey' => 'state_id',
        ]);
        $this->hasMany('RatSnapshots', [
            'foreignKey' => 'state_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'state_id',
        ]);
        $this->hasMany('Ratteries', [
            'foreignKey' => 'state_id',
        ]);
        $this->hasMany('RatterySnapshots', [
            'foreignKey' => 'state_id',
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
            ->scalar('color')
            ->maxLength('color', 6)
            ->allowEmptyString('color');

        $validator
            ->scalar('symbol')
            ->maxLength('symbol', 1)
            ->requirePresence('symbol', 'create')
            ->notEmptyString('symbol');

        $validator
            ->scalar('css_property')
            ->maxLength('css_property', 45)
            ->allowEmptyString('css_property');

        $validator
            ->boolean('is_default')
            ->notEmptyString('is_default');

        $validator
            ->boolean('needs_user_action')
            ->notEmptyString('needs_user_action');

        $validator
            ->boolean('needs_staff_action')
            ->notEmptyString('needs_staff_action');

        $validator
            ->boolean('is_reliable')
            ->notEmptyString('is_reliable');

        $validator
            ->boolean('is_visible')
            ->notEmptyString('is_visible');

        $validator
            ->boolean('is_searchable')
            ->notEmptyString('is_searchable');

        $validator
            ->boolean('is_frozen')
            ->notEmptyString('is_frozen');

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
        $rules->add($rules->existsIn(['next_ok_state_id'], 'NextOkStates'));
        $rules->add($rules->existsIn(['next_ko_state_id'], 'NextKoStates'));
        $rules->add($rules->existsIn(['next_frozen_state_id'], 'NextFrozenStates'));
        $rules->add($rules->existsIn(['next_thawed_state_id'], 'NextThawedStates'));

        return $rules;
    }
}
