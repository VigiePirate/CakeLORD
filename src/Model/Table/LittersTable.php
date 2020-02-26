<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Litters Model
 *
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsTo $Ratteries
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\BelongsTo $Rats
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\BelongsTo $Rats
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\ConversationsTable&\Cake\ORM\Association\HasMany $Conversations
 * @property \App\Model\Table\LitterSnapshotsTable&\Cake\ORM\Association\HasMany $LitterSnapshots
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 *
 * @method \App\Model\Entity\Litter newEmptyEntity()
 * @method \App\Model\Entity\Litter newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Litter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Litter get($primaryKey, $options = [])
 * @method \App\Model\Entity\Litter findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Litter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Litter[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Litter|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Litter saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Litter[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Litter[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Litter[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Litter[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LittersTable extends Table
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

        $this->setTable('litters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ratteries', [
            'foreignKey' => 'rattery_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MotherRats', [
            'className'=> 'Rats',
            'foreignKey' => 'mother_rat_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('FatherRats', [
            'className'=> 'Rats',
            'foreignKey' => 'father_rat_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'creator_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Conversations', [
            'foreignKey' => 'litter_id',
        ]);
        $this->hasMany('LitterSnapshots', [
            'foreignKey' => 'litter_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'litter_id',
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
            ->date('mating_date')
            ->allowEmptyDate('mating_date');

        $validator
            ->date('birth_date')
            ->requirePresence('birth_date', 'create')
            ->notEmptyDate('birth_date');

        $validator
            ->requirePresence('pups_number', 'create')
            ->notEmptyString('pups_number');

        $validator
            ->allowEmptyString('pups_number_stillborn');

        $validator
            ->scalar('comments')
            ->allowEmptyString('comments');

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
        $rules->add($rules->existsIn(['mother_rat_id'], 'Rats'));
        $rules->add($rules->existsIn(['father_rat_id'], 'Rats'));
        $rules->add($rules->existsIn(['creator_user_id'], 'Users'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
