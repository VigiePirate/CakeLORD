<?php
declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\Validation\Validator;
use Cake\Collection\Collection;


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
        $this->addBehavior('State', [
            'safe_properties' => [
                'modified',
                'state_id',
                'pups_number',
            ],
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
     * beforeMarshal method
     *
     * @param EventInterface $event
     * @param ArrayObject $data
     * @param ArrayObject $options
     * @return void
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        $rats = \Cake\Datasource\FactoryLocator::get('Table')->get('Rats');

        // javacript fallback for parent input data
        if (empty($data['mother_id']) && ! empty($data['mother_name'])) {
            $mother = $rats->findByPedigreeIdentifier($data['mother_name'])->first();
            if ((! empty($mother)) && $mother['sex'] == 'F') {
                $data['mother_id'] = $mother['0']['id'];
            }
        }

        if (empty($data['father_id']) && ! empty($data['father_name'])) {
            $father = $rats->findByPedigreeIdentifier($data['father_name'])->first();
            if ((! empty($father)) && $father['sex'] == 'M') {
                $data['father_id'] = $father['0']['id'];
            }
        }

        if (isset($data['mother_id'])) {
            if (! isset($data['father_id'])) {
                $data['parent_rats'] = ['_ids' => [$data['mother_id']]];
            } else {
                $data['parent_rats'] = ['_ids' => [$data['mother_id'], $data['father_id']]];
            }
        }

        // javacript fallback for rattery
        if (! isset($data['rattery_id']) || empty($data['rattery_id'])) {
            if (isset($data['generic_rattery_id']) && ! empty($data['generic_rattery_id'])) {
                $data['rattery_id'] = $data['generic_rattery_id'];
            } else {
                if (empty($data['nongeneric_rattery_id'])) {
                    $ratteries = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries');
                    $rattery = $ratteries->findByPrefix($data['rattery_name'])->all()->toList();
                    if (! empty($rattery)) {
                        $data['rattery_id'] = $rattery['0']['id'];
                    }
                } else {
                    $data['rattery_id'] = $data['nongeneric_rattery_id'];
                }
            }
        }

        if (isset($data['rattery_id']) && ! empty($data['rattery_id']) && ! isset($data['contributions'])) {
            $data['contributions'] = [
                [
                    'contribution_type_id' => '1',
                    'rattery_id' => $data['rattery_id'],
                ]
            ];
        }
        return;
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
        // $rules->add($rules->isUnique(['birth_date', 'parents._ids']));

        /* Mother existence */
        $rules->addCreate(function($litter) {
                return $litter->hasMother();
            },
            'mother_selected',
            [
                'errorField' => 'mother_name',
                'message' => 'We could not find the mother. Please, select it in the list or type its complete pedigree identifier.'
            ]
        );

        /* Father was tentatively selected but not found */
        $rules->addCreate(function($litter) {
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

        /* Mandatory origin information */
        $rules->add(function ($litter) {
                return $litter->hasValidOrigins();
            },
            'validOrigins',
            [
                'errorField' => 'comments',
                'message' => 'Incomplete: mandatory information about origins are missing.
                <ul><li>For a generic origin, please add a comment (name and location, circumstances of the rescue, etc.)</li>
                <li>For a registered rattery, add at least a mother. Create her first if needed, or chose a generic origin.</li></ul>'
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

        /* offspring must all have the same birth date */
        $rules->add(function($litter) {
                return $litter->homogeneizeBirthDates();
            },
            'homogeneousBirthDates',
            [
                'errorField' => 'birth_date',
                'message' => 'Something went wrong when updating birth dates.'
            ]
        );

        $rules->add(function($litter) {
                return $litter->homogeneizePrefixes();
            },
            'homogeneousPrefixes',
            [
                'errorField' => 'rattery_name_contribution_1',
                'message' => 'Something went wrong when updating prefixes.'
            ]
        );

        /* Pups count coherence */
        $rules->add(function($litter) {
                return $litter->checkPupCount();
            },
            'tooManyPups',
            [
                'errorField' => 'pups_number',
                'message' => 'Impossible: lower than the number of recorded pups.'
            ]
        );

        $rules->add(function($litter) {
                return $litter->checkStillbornCount();
            },
            'tooManyStillborn',
            [
                'errorField' => 'pups_number_stillborn',
                'message' => 'Impossible: larger than the total number of pups.'
            ]
        );

        return $rules;
    }

    /**
     * beforeSave method
     *
     * Automatically complete contributions and activate ratteries before saving litter.
     * FIXME: could be done with a rule instead
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $rats = \Cake\Datasource\FactoryLocator::get('Table')->get('Rats');
        $ratteries = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries');
        $contributions = \Cake\Datasource\FactoryLocator::get('Table')->get('Contributions');

        if ($entity->isNew()) {
            foreach ($entity->parent_rats as $parent_ref) {
                $parent = $rats->get($parent_ref['id'], [
                    'contain' => ['OwnerUsers', 'OwnerUsers.Ratteries']
                ]);

                $parent_rattery = $parent->owner_user->main_rattery;

                if (! empty($parent_rattery) && $entity->contributions['0']->rattery_id != $parent_rattery->id) {
                    if ($parent->sex == 'F') {
                        array_push($entity->contributions, $contributions->newEntity([
                            'contribution_type_id' => '2',
                            'rattery_id' => $parent_rattery->id,
                        ]));
                    } else {
                        array_push($entity->contributions, $contributions->newEntity([
                            'contribution_type_id' => '3',
                            'rattery_id' => $parent_rattery->id,
                        ]));
                    }
                }
            }
        } else { // entity is not new and parents have been edited: delete contributions (worst case)
            if (isset($entity['parent_rats']) && $entity->isDirty('parent_rats')) {
                $old_parents = new Collection($entity->getOriginal('parent_rats'));
                foreach ($entity->parent_rats as $parent) {
                    if (! $old_parents->contains($parent)) {
                        if ($parent->sex == 'F') {
                            $contribution2 = $contributions->find('fromLitterAndType', [
                                'litter_id' => [$entity->id],
                                'contribution_type_id' => ['2']]
                                )->first();
                            if (! is_null($contribution2)) {
                                $contributions->delete($contribution2);
                                unset($entity->contribution['1']);
                            }
                        }
                        if ($parent->sex == 'M') {
                            $contribution3 = $contributions->find('fromLitterAndType', [
                                'litter_id' => [$entity->id],
                                'contribution_type_id' => ['3']]
                                )->first();
                            if (! is_null($contribution3)) {
                                $contributions->delete($contribution3);
                                unset($entity->contribution['2']);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * afterSave method
     *
     * Update ratteries activities
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $ratteries = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries');
        $now = \Cake\I18n\FrozenTime::now();
        foreach ($entity->contributions as $contribution) {
            $rattery = $ratteries->get($contribution->rattery_id, ['contain' => ['Countries']]);
            if (! $rattery->is_alive && $now->diffInDays($entity->birth_date) < RatteriesTable::MAXIMAL_INACTIVITY) {
                $rattery->is_alive = true;
                $ratteries->save($rattery, ['checkRules' => false, 'atomic' => false]);
            }
        }
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
