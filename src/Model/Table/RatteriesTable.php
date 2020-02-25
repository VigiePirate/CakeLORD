<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ratteries Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\ConversationsTable&\Cake\ORM\Association\HasMany $Conversations
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\HasMany $Litters
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 * @property \App\Model\Table\RatterySnapshotsTable&\Cake\ORM\Association\HasMany $RatterySnapshots
 *
 * @method \App\Model\Entity\Rattery get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rattery newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rattery[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rattery|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rattery saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rattery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rattery[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rattery findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RatteriesTable extends Table
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

        $this->setTable('ratteries');
        $this->setDisplayField('prefix');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'owner_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Conversations', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->hasMany('Litters', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->hasMany('MChildrenRats', [
            'className' => 'Rats',
            'foreignKey' => 'mother_rattery_id',
        ]);
        $this->hasMany('FChildrenRats', [
            'className' => 'Rats',
            'foreignKey' => 'father_rattery_id',
        ]);
        $this->hasMany('RatterySnapshots', [
            'foreignKey' => 'rattery_id',
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
            ->scalar('prefix')
            ->maxLength('prefix', 3)
            ->requirePresence('prefix', 'create')
            ->notEmptyString('prefix')
            ->add('prefix', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('comments')
            ->allowEmptyString('comments');

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->allowEmptyString('picture');

        $validator
            ->boolean('is_alive')
            ->notEmptyString('is_alive');

        $validator
            ->scalar('birth_year')
            ->allowEmptyString('birth_year');

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
        $rules->add($rules->isUnique(['prefix']));
        $rules->add($rules->existsIn(['owner_id'], 'Users'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
