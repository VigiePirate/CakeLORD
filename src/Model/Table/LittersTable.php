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
use Cake\I18n\FrozenTime;


/**
 * Litters Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\LitterMessagesTable&\Cake\ORM\Association\HasMany $LitterMessages
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
    const MAXIMAL_PUP_NUMBER = 24;
    const MINIMAL_PREGNANCY_DURATION = 21;
    const MAXIMAL_PREGNANCY_DURATION = 25;

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
        $this->addBehavior('Message', [
            'repository' => 'LitterMessages',
            'entityField' => 'litter_id',
        ]);
        $this->addBehavior('State', [
            'safe_properties' => [
                'modified',
                'state_id',
                'pups_number',
                'comments',
            ],
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'creator_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
            'safe_properties' => [
                'state_id',
                'mating_date',
                'pups_number_stillborn',
                'comments'
            ]
        ]);
        $this->hasMany('LitterSnapshots', [
            'foreignKey' => 'litter_id',
            'dependent' => true,
        ]);
        $this->hasMany('LitterMessages', [
            'foreignKey' => 'litter_id',
            'dependent' => true,
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
            'saveStrategy' => 'replace',
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

        // javacript fallback for rattery at litter creation
        // FIXME: replace ugly test by proper case management
        if (
            ! isset($data['side_message'])
            && (! isset($data['rattery_name_contribution_1']))
            && (! isset($data['rattery_id']) || empty($data['rattery_id']))
        ) {
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

        // litter creation case: first contribution must be created
        if (! isset($data['side_message']) && ! isset($data['rattery_name_contribution_1'])) {
            $data['contributions'] = [
                [
                    'contribution_type_id' => '1',
                    'rattery_id' => $data['rattery_id'],
                ]
            ];
        }

        // litter edition (with or without side message)
        if (isset($data['rattery_name_contribution_1'])) {
            // contributions have been manually edited; replace litter contributions by form data
            // FIXME assumes there are at most 9 contribution types
            $keys = array_keys((array)$data);
            foreach ($keys as $key) {
                if (substr($key, 0, -1) == 'rattery_id_contribution_') {
                    $k = intval(substr($key, -1));
                    if ($k >= 1 && strlen($data['rattery_id_contribution_'.$k]) != 0 ) {
                        $data['contributions'][$k-1]['rattery_id'] = $data['rattery_id_contribution_'.$k];
                        $data['contributions'][$k-1]['contribution_type_id'] = $k;
                        $data['contributions'][$k-1]['litter_id'] = $data['litter_id'];
                    }
                }
            }
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
        $rules->add(function($litter) {
                return $litter->hasMother();
            },
            'mother_selected',
            [
                'errorField' => 'mother_name',
                'message' => __('We could not find the mother. Please, select it in the list or type its complete pedigree identifier.')
            ]
        );

        /* Father was tentatively selected but not found */
        $rules->addCreate(function($litter) {
                return $litter->hasRealFather();
            },
            'father_selected',
            [
                'errorField' => 'father_name',
                'message' => __('We could not find the father. Please, select it in the list or type its complete pedigree identifier.')
            ]
        );

        /* Birth place */
        $rules->add(function($litter) {
                return $litter->hasBirthPlace();
            },
            'rattery_selected',
            [
                'errorField' => 'rattery_name',
                'message' => __('We could not find this rattery. Please, select it in the list or type an existing prefix.')
            ]
        );

        /* Birth place cannot be a definitely closed rattery */
        $rules->addCreate(function($litter) {
                return $litter->hasActivableBirthPlace();
            },
            'rattery_closed',
            [
                'errorField' => 'rattery_name',
                'message' => __('This rattery has been definitely closed. Please, select an eligible rattery (either active, or the last active rattery of its owner).')
            ]
        );

        /* Mandatory origin information */
        $rules->addCreate(function ($litter) {
                return $litter->hasValidOrigins();
            },
            'validOrigins',
            [
                'errorField' => 'origin_errors',
                'message' => __('Incomplete: mandatory information about origins are missing.
                <ul><li>For a generic origin (any origin but registered ratteries), please add relevant information in comments: name and location, circumstances of the rescue, etc.</li>
                <li>For a registered rattery, add at least a mother. Create her first if needed, or chose a generic origin.</li></ul>')
            ]
        );

        /* No birth in the future */
        $rules->add(function ($litter) {
                return ! $litter->isBornFuture();
            },
            'bornFuture',
            [
                'errorField' => 'birth_date',
                'message' => __('Impossible: this date is in the future.')
            ]
        );

        /* No birth near existing one from the same mother */
        $rules->addCreate(function ($litter) {
                return ! $litter->hasTooCloseSiblings();
            },
            'hasCloseSiblings',
            [
                'errorField' => 'birth_date',
                'message' => __('Impossible: the date is too close from the birth of another litter with the same mother.')
            ]
        );

        /* Mating should be 20-28 days before birth */
        $rules->add(function($litter) {
                return ! $litter->isAbnormalPregnancy();
            },
            'abnormalPregnancy',
            [
                'errorField' => 'mating_date',
                'message' => __('Impossible: mating happens at least {0} days and at most {1} days before birth.', [
                    LittersTable::MINIMAL_PREGNANCY_DURATION, LittersTable::MAXIMAL_PREGNANCY_DURATION
                ]),
            ]
        );

        /* No unborn parents */
        $rules->add(function($litter) {
                return $litter->wasBornMother();
            },
            'wasBornMother',
            [
                'errorField' => 'birth_date',
                'message' => __('Impossible: mother had not been born at this date.')
            ]
        );

        $rules->add(function($litter) {
                return $litter->wasBornFather();
            },
            'wasBornFather',
            [
                'errorField' => 'birth_date',
                'message' => __('Impossible: father had not been born at this date.')
            ]
        );

        /* No dead parents */
        $rules->add(function($litter) {
                return $litter->wasAliveMother();
            },
            'wasAliveMother',
            [
                'errorField' => 'birth_date',
                'message' => __('Impossible: mother was dead at this date.')
            ]
        );

        $rules->add(function($litter) {
                return $litter->wasAliveFather();
            },
            'wasAliveFather',
            [
                'errorField' => 'birth_date',
                'message' => __('Impossible: father was dead too long before this date.')
            ]
        );

        $rules->add(function($litter) {
                return $litter->areCompatibleParents();
            },
            'areCompatibleParents',
            [
                'errorField' => 'father_name',
                'message' => __('Impossible: father and mother were never alive at the same time.')
            ]
        );

        /* offspring must all have the same birth date */
        $rules->addUpdate(function($litter) {
                return $litter->homogeneizeBirthDates();
            },
            'homogeneousBirthDates',
            [
                'errorField' => 'birth_date',
                'message' => __('Something went wrong when updating offspring birth dates.')
            ]
        );

        $rules->addUpdate(function($litter) {
                return $litter->homogeneizePrefixes();
            },
            'homogeneousPrefixes',
            [
                'errorField' => 'rattery_name_contribution_1',
                'message' => __('Something went wrong when updating offspring prefixes.')
            ]
        );

        /* Pups count coherence */
        $rules->add(function($litter) {
                return $litter->checkPupCount();
            },
            'tooManyPups',
            [
                'errorField' => 'pups_number',
                'message' => __('Impossible: lower than the number of recorded pups.')
            ]
        );

        $rules->add(function($litter) {
                return $litter->checkStillbornCount();
            },
            'tooManyStillborn',
            [
                'errorField' => 'pups_number_stillborn',
                'message' => __('Impossible: larger than the total number of pups.')
            ]
        );

        $rules->add(function($litter) {
                return $litter->checkMaxPupCount();
            },
            'tooManyPups',
            [
                'errorField' => 'pups_number',
                'message' => __('Impossible: rats do not have such large litters.')
            ]
        );

        $rules->add(function($litter) {
                return $litter->checkMaxStillbornCount();
            },
            'tooManyPups',
            [
                'errorField' => 'pups_number_stillborn',
                'message' => __('Impossible: rats do not have such large litters.')
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
        } else {
            // if entity is updated, we dont want to save rats twice
            // (they have been saved in the rules if it was necessary)
            $entity->setDirty('offspring_rats', false);

            // if parents were edited, the parent_rats association must be fixed after snapshot was taken
            if (isset($entity->parent_rats)) {
                $swap_parents = $entity->parent_rats;
                $entity->parent_rats = [];
                foreach ($swap_parents as $swap_parent) {
                    $parent = $rats->get($swap_parent['id']);
                    array_push($entity->parent_rats, $parent);
                }
                $entity->setDirty('parent_rats', true);
            }

            // if entity is updated, check if some contributions must be deleted
            if (isset($entity->contributions)) {
                $old_contributions = $entity->getOriginal('contributions');

                // if $entity->contributions contains arrays, we come from snapRestore : we need to convert it to entities
                // if $entity->contributions contains contributions, we come from manageContributions : nothing to do
                if (is_array($entity->contributions[0])) {
                    $swap_contributions = $entity->contributions;
                    $entity->contributions = [];
                    foreach ($swap_contributions as $swap_contribution) {
                        array_push($entity->contributions, $contributions->newEntity($swap_contribution));
                    }
                }

                $entity->setDirty('contributions', true);
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

        // set dates
        $now = FrozenTime::today();
        if (is_string($entity->birth_date)) {
            $birth_date = FrozenTime::createFromFormat('Y-m-d', $entity->birth_date);
        }
        foreach ($entity->contributions as $contribution) {
            $rattery = $ratteries->get($contribution->rattery_id, ['contain' => ['Countries', 'Users']]);
            //FIXME check if rattery has sisters to deactivate them? in the Rattery rules maybe?
            if (! $rattery->is_alive && $now->diffInDays($birth_date) < RatteriesTable::MAXIMAL_INACTIVITY) {
                $rattery->is_alive = true;
                $ratteries->save($rattery, ['atomic' => false, 'associated' => []]);
            }
        }
    }

    public function findEntitledBy(Query $query, array $options)
    {
        $query = $query
            ->select('id')
            ->distinct();

        if (empty($options['user_id'])) {
            $query->leftJoinWith('Users')
                  ->where(['Users.id IS' => null]);
        } else {
            $user_id = $options['user_id'];

            $query2 = $query->cleanCopy();

            $query1 = $query
                ->innerJoinWith('Users')
                ->contain('States')
                ->where(['Users.id' => $options['user_id']]);

            $query2 = $query2
                ->contain(['Contributions', 'States'])
                ->matching('Contributions.Ratteries', function (\Cake\ORM\Query $q) use ($user_id) {
                  return $q->where([
                      'Ratteries.owner_user_id' => $user_id,
                  ]);
              });

            $query = $query1->union($query2);
        }
        return $query->group(['Litters.id']);
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

    public function findNeedsStaff(Query $query, array $options)
    {
        return $query
            ->select()
            ->distinct()
            ->where(['States.needs_staff_action IS' => true])
            ->contain(['States', 'Contributions'])
            ->group(['Litters.id']);
    }

    public function findNeedsUser(Query $query, array $options)
    {
        return $query
            ->select()
            ->distinct()
            ->contain(['States', 'Contributions'])
            ->where(['States.needs_user_action IS' => true])
            ->group(['Litters.id']);
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

    public function findFromBirthRange(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        $birth_date = $options['birth_date'];
        $mother_id = $options['mother_id'];
        $query = $query
            ->matching('ParentRats', function ($q) use ($mother_id) {
                return $q->where(['ParentRats.id' => $mother_id]);
            })
            ->where([
                'Litters.birth_date >=' => $birth_date->modify('-'.LittersTable::MINIMAL_PREGNANCY_DURATION.' days'),
                'Litters.birth_date <=' => $birth_date->modify('+'.LittersTable::MINIMAL_PREGNANCY_DURATION.' days')
            ]);

        return $query->group(['Litters.id']);
    }
}
