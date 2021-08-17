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
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\ConversationsTable&\Cake\ORM\Association\HasMany $Conversations
 * @property \App\Model\Table\LitterSnapshotsTable&\Cake\ORM\Association\HasMany $LitterSnapshots
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $OffspringRats
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\BelongsToMany $ParentRats
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsToMany $Ratteries
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
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Snapshot', [
            'repository' => 'LitterSnapshots',
            'entityField' => 'litter_id',
        ]);
        $this->addBehavior('State');

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
        $this->hasMany('OffspringRats', [
            'className' => 'Rats',
            'foreignKey' => 'litter_id',
            'sort' => ['OffspringRats.name' => 'ASC'],
        ]);
        $this->belongsToMany('ParentRats', [
            'className' => 'Rats',
            'foreignKey' => 'litter_id',
            'targetForeignKey' => 'rat_id',
            'joinTable' => 'rats_litters',
        ]);
        $this->belongsToMany('Sire', [
            'className' => 'Rats',
            'foreignKey' => 'litter_id',
            'targetForeignKey' => 'rat_id',
            'joinTable' => 'rats_litters',
            'finder' => 'Males',
        ]);
        $this->belongsToMany('Dam', [
            'className' => 'Rats',
            'foreignKey' => 'litter_id',
            'targetForeignKey' => 'rat_id',
            'joinTable' => 'rats_litters',
            'finder' => 'Females',
        ]);
        $this->belongsToMany('Ratteries', [
            'through' => 'Contributions',
        ]);
        $this->hasMany('Contributions', [
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
        $rules->add($rules->existsIn(['creator_user_id'], 'Users'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        /* Mother existence */
        $rules->add(function($litter) {
                return $litter->hasMother();
            },
            'mother_selected',
            [
                'errorField' => 'mother_name',
                'message' => 'We could not find the mother. Please, select it in the list or type its complete pedigree identifier.'
            ]
        );

        /* Father was tentatively selected but not found */
        $rules->add(function($litter) {
                return $litter->hasRealFather();
            },
            'father_selected',
            [
                'errorField' => 'father_name',
                'message' => 'We could not find the father. Please, select it in the list or type its complete pedigree identifier.'
            ]
        );

        /* Birth place */
        $rules->add(function($litter) {
                return $litter->hasBirthPlace();
            },
            'rattery_selected',
            [
                'errorField' => 'rattery_name',
                'message' => 'We could not find this rattery. Please, select it in the list or type an existing prefix.'
            ]
        );

        /* No birth in the future */
        $rules->add(function ($litter) {
                return ! $litter->isBornFuture();
            },
            'bornFuture',
            [
                'errorField' => 'birth_date',
                'message' => 'Impossible: this date is in the future.'
            ]
        );

        /* Mating should be 20-28 days before birth */
        $rules->add(function($litter) {
                return ! $litter->isAbnormalPregnancy();
            },
            'abnormalPregnancy',
            [
                'errorField' => 'mating_date',
                'message' => 'Impossible: mating happens at least 20 days and at most 25 days before birth.'
            ]
        );

        /* No unborn parents */
        $rules->add(function($litter) {
                return $litter->wasBornMother();
            },
            'wasBornMother',
            [
                'errorField' => 'birth_date',
                'message' => 'Impossible: mother had not been born at this date.'
            ]
        );

        $rules->add(function($litter) {
                return $litter->wasBornFather();
            },
            'wasBornFather',
            [
                'errorField' => 'birth_date',
                'message' => 'Impossible: father had not been born at this date.'
            ]
        );

        /* No dead parents */
        $rules->add(function($litter) {
                return $litter->wasAliveMother();
            },
            'wasAliveMother',
            [
                'errorField' => 'birth_date',
                'message' => 'Impossible: mother was dead at this date.'
            ]
        );

        $rules->add(function($litter) {
                return $litter->wasAliveFather();
            },
            'wasAliveFather',
            [
                'errorField' => 'birth_date',
                'message' => 'Impossible: father was dead too long before this date.'
            ]
        );

        $rules->add(function($litter) {
                return $litter->areCompatibleParents();
            },
            'areCompatibleParents',
            [
                'errorField' => 'father_name',
                'message' => 'Impossible: father and mother were never alive at the same time.'
            ]
        );

        return $rules;
    }

    public function findInState(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['inState'])) {
            $query->where([
                'Litters.state_id IS' => null,
            ]);
        } else {
            $inState = implode($options['inState']);
            $query->where([
                    'Litters.state_id IS' => $inState,
            ]);
        }

        return $query->group(['Litters.id']);
    }

    public function findFromBirth(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        $birth_date = $options['birth_date'];
        $mother_id = $options['mother_id'];
        $query = $query
            ->where(['Litters.birth_date IS' => $birth_date])
            ->matching('ParentRats', function ($q) use ($mother_id) {
                return $q->where(['ParentRats.id' => $mother_id]);
            });

        return $query->group(['Litters.id']);
    }
}
