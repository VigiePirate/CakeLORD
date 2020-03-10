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
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\ConversationsTable&\Cake\ORM\Association\HasMany $Conversations
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 * @property \App\Model\Table\RatterySnapshotsTable&\Cake\ORM\Association\HasMany $RatterySnapshots
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsToMany $Litters
 *
 * @method \App\Model\Entity\Rattery newEmptyEntity()
 * @method \App\Model\Entity\Rattery newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Rattery[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rattery get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rattery findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Rattery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rattery[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rattery|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rattery saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
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
            'foreignKey' => 'owner_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Conversations', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->hasMany('RatterySnapshots', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->belongsToMany('Litters', [
            'foreignKey' => 'rattery_id',
            'targetForeignKey' => 'litter_id',
            'joinTable' => 'ratteries_litters',
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
            ->scalar('prefix')
            ->maxLength('prefix', 4)
            ->requirePresence('prefix', 'create')
            ->notEmptyString('prefix')
            ->add('prefix', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 70)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('birth_year')
            ->allowEmptyString('birth_year');

        $validator
            ->boolean('is_alive')
            ->notEmptyString('is_alive');

        $validator
            ->boolean('is_generic')
            ->notEmptyString('is_generic');

        $validator
            ->scalar('district')
            ->maxLength('district', 70)
            ->allowEmptyString('district');

        $validator
            ->scalar('zip_code')
            ->maxLength('zip_code', 12)
            ->allowEmptyString('zip_code');

        $validator
            ->scalar('website')
            ->maxLength('website', 255)
            ->allowEmptyString('website');

        $validator
            ->scalar('comments')
            ->allowEmptyString('comments');

        $validator
            ->boolean('wants_statistic')
            ->notEmptyString('wants_statistic');

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
        $rules->add($rules->isUnique(['prefix']));
        $rules->add($rules->existsIn(['owner_user_id'], 'Users'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
