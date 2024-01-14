<?php
declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Datasource\EntityInterface;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Collection\Collection;
use Cake\Routing\Router;

/**
 * Rats Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsTo $Ratteries
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsTo $BirthLitters
 * @property \App\Model\Table\ColorsTable&\Cake\ORM\Association\BelongsTo $Colors
 * @property \App\Model\Table\EyecolorsTable&\Cake\ORM\Association\BelongsTo $Eyecolors
 * @property \App\Model\Table\DilutionsTable&\Cake\ORM\Association\BelongsTo $Dilutions
 * @property \App\Model\Table\MarkingsTable&\Cake\ORM\Association\BelongsTo $Markings
 * @property \App\Model\Table\EarsetsTable&\Cake\ORM\Association\BelongsTo $Earsets
 * @property \App\Model\Table\CoatsTable&\Cake\ORM\Association\BelongsTo $Coats
 * @property \App\Model\Table\DeathPrimaryCausesTable&\Cake\ORM\Association\BelongsTo $DeathPrimaryCauses
 * @property \App\Model\Table\DeathSecondaryCausesTable&\Cake\ORM\Association\BelongsTo $DeathSecondaryCauses
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\RatMessagesTable&\Cake\ORM\Association\HasMany $RatMessages
 * @property \App\Model\Table\RatSnapshotsTable&\Cake\ORM\Association\HasMany $RatSnapshots
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsToMany $BredLitters
 * @property \App\Model\Table\SingularitiesTable&\Cake\ORM\Association\BelongsToMany $Singularities
 *
 * @method \App\Model\Entity\Rat newEmptyEntity()
 * @method \App\Model\Entity\Rat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Rat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Rat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RatsTable extends Table
{
    const MAXIMAL_AGE = 1645;
    const MAXIMAL_AGE_MONTHS = 54;
    const MAXIMAL_INFANT_AGE = 42;
    const MINIMAL_OLDSTER_AGE = 24;

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
            ->allowEmptyString('id', null, 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('pedigree_identifier')
            ->maxLength('pedigree_identifier', 16)
            ->allowEmptyString('pedigree_identifier')
            ->add('pedigree_identifier', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('is_pedigree_custom')
            ->notEmptyString('is_pedigree_custom');

        $validator
            ->scalar('name')
            ->maxLength('name', 70)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('pup_name')
            ->maxLength('pup_name', 70)
            ->allowEmptyString('pup_name');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 1)
            ->requirePresence('sex', 'create')
            ->notEmptyString('sex')
            ->add('sex', 'validSex', ['rule' => 'isValidSex', 'message' => __('Sex must be either M or F'), 'provider' => 'table']);

        $validator
            ->date('birth_date')
            ->requirePresence('birth_date', 'create')
            ->notEmptyDate('birth_date');

        $validator
            ->boolean('is_alive')
            ->notEmptyString('is_alive');

        $validator
            ->date('death_date')
            ->allowEmptyDate('death_date');

        $validator
            ->boolean('death_euthanized')
            ->allowEmptyString('death_euthanized');

        $validator
            ->boolean('death_diagnosed')
            ->allowEmptyString('death_diagnosed');

        $validator
            ->boolean('death_necropsied')
            ->allowEmptyString('death_necropsied');

        $validator
            ->scalar('comments')
            ->allowEmptyString('comments');

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->allowEmptyString('picture');

        $validator
            ->scalar('picture_thumbnail')
            ->maxLength('picture_thumbnail', 255)
            ->allowEmptyString('picture_thumbnail');

        return $validator;
    }

    public function isValidSex($value, array $context)
    {
            return in_array($value, ['M', 'F'], true);
        }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('rats');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Picture', [
            'thumbnail' => true,
            'thumbWidth' => 45,
            'thumbHeight' => 30
        ]);
        $this->addBehavior('Snapshot', [
            'repository' => 'RatSnapshots',
            'entityField' => 'rat_id',
        ]);
        $this->addBehavior('Message', [
            'repository' => 'RatMessages',
            'entityField' => 'rat_id',
        ]);
        $this->addBehavior('State', [
            'safe_properties' => [
                'name',
                'pup_name',
                'owner_user_id',
                'comments',
            ],
        ]);

        $this->belongsTo('OwnerUsers', [
            'className' => 'Users',
            'foreignKey' => 'owner_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Ratteries', [
            'foreignKey' => 'rattery_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('BirthLitters', [
            'className' => 'Litters',
            'foreignKey' => 'litter_id',
        ]);
        $this->belongsTo('Colors', [
            'foreignKey' => 'color_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Eyecolors', [
            'foreignKey' => 'eyecolor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Dilutions', [
            'foreignKey' => 'dilution_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Markings', [
            'foreignKey' => 'marking_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Earsets', [
            'foreignKey' => 'earset_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Coats', [
            'foreignKey' => 'coat_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DeathPrimaryCauses', [
            'foreignKey' => 'death_primary_cause_id',
        ]);
        $this->belongsTo('DeathSecondaryCauses', [
            'foreignKey' => 'death_secondary_cause_id',
        ]);
        $this->belongsTo('CreatorUsers', [
            'className' => 'Users',
            'foreignKey' => 'creator_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('RatSnapshots', [
            'foreignKey' => 'rat_id',
            'dependent' => true,
        ]);
        $this->hasMany('RatMessages', [
            'foreignKey' => 'rat_id',
            'dependent' => true,
        ]);
        $this->belongsToMany('BredLitters', [
            'className' => 'Litters',
            'foreignKey' => 'rat_id',
            'targetForeignKey' => 'litter_id',
            'joinTable' => 'rats_litters',
        ]);
        $this->belongsToMany('Singularities', [
            'foreignKey' => 'rat_id',
            'targetForeignKey' => 'singularity_id',
            'joinTable' => 'rats_singularities',
        ]);

        // Event related
        $this->Identity = Router::getRequest()->getAttribute('identity');
        $this->now = \Cake\Chronos\Chronos::now();
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
        // $owner_user_id
        if (isset($data['creator_user_id']) && (! isset($data['owner_user_id']) || $data['owner_user_id'] == '')) {
            $data['owner_user_id'] = $data['creator_user_id'];
        }

        // $rattery_id
        if (! isset($data['rattery_id']) && isset($data['rattery_name'])) {
            if (isset($data['generic_rattery_id']) && ! empty($data['generic_rattery_id'])) {
                $data['rattery_id'] = $data['generic_rattery_id'];
            } else {
                if (empty($data['nongeneric_rattery_id'])) {
                    $ratteries = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries');
                    $rattery = $ratteries->findByPrefix($data['rattery_name'])->all()->toList();
                    if (! empty($rattery)) {
                        $data['rattery_id'] = $rattery[0]['id'];
                    }
                } else {
                    $data['rattery_id'] = $data['nongeneric_rattery_id'];
                }
            }
        }

        // staff edit case (prefix edition)
        if (
            ! isset($data['rattery_id'])
            && ! isset($data['rattery_name'])
            && isset($data['generic_rattery_id'])
            && ! empty($data['generic_rattery_id'])
        ) {
            $data['rattery_id'] = $data['generic_rattery_id'];
        }

        // check if death was recorded at creation
        if (isset($data['is_dead'])) {
            $data['is_alive'] = ! $data['is_dead'];
            if ($data['is_alive']) {
                unset($data['death_primary_cause_id']);
                unset($data['death_secondary_cause_id']);
            }
        }
    }

    /**
     * afterMarshal method
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $data
     * @param ArrayObject $options
     * @return void
     */
    public function afterMarshal(EventInterface $event, EntityInterface $entity, ArrayObject $data, ArrayObject $options)
    {
        if($entity->isNew()) {
            // default values
            $entity->is_alive = isset($data['is_alive']) ? $data['is_alive'] : true;
            $entity->is_pedigree_custom = false;

            // has to be explicitly set since creator_user_id is not "accessible"
            $entity->creator_user_id = (int)$data['creator_user_id'];

            // contain rattery for origin checks
            if (isset($data['rattery_id'])) {
                $entity->rattery = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries')->get($entity->rattery_id);
            }
        }
    }

    public function beforeFind(EventInterface $event, Query $query, ArrayObject $options, $primary)
    {
        if (isset($options['searchable_only']) && $options['searchable_only']) {
            $query->innerJoinWith('States', function ($q) {
                return $q->where(['is_searchable' => true]);
            });
        }
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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->isUnique(['pedigree_identifier']));
        $rules->add($rules->existsIn(['owner_user_id'], 'OwnerUsers'));
        $rules->add($rules->existsIn(['rattery_id'], 'Ratteries'));
        $rules->add($rules->existsIn(['litter_id'], 'BirthLitters'));
        $rules->add($rules->existsIn(['color_id'], 'Colors'));
        $rules->add($rules->existsIn(['eyecolor_id'], 'Eyecolors'));
        $rules->add($rules->existsIn(['dilution_id'], 'Dilutions'));
        $rules->add($rules->existsIn(['marking_id'], 'Markings'));
        $rules->add($rules->existsIn(['earset_id'], 'Earsets'));
        $rules->add($rules->existsIn(['coat_id'], 'Coats'));

        $rules->add($rules->existsIn(['death_primary_cause_id'], 'DeathPrimaryCauses'));
        $rules->add($rules->existsIn(['death_secondary_cause_id'], 'DeathSecondaryCauses'));
        $rules->add($rules->existsIn(['creator_user_id'], 'CreatorUsers'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        /* Rats must have a proper name */
        $rules->add(function ($rat) {
                return ! $rat->hasInvalidName();
            },
            'validName',
            [
                'errorField' => 'name',
                'message' => __('Forbidden: names such as “F1” or “M4” are not allowed.')
            ]
        );

        /* No rat born in the future */
        $rules->add(function ($rat) {
                return ! $rat->isBornFuture();
            },
            'bornFuture',
            [
                'errorField' => 'birth_date',
                'message' => __('Impossible: this date is in the future.')
            ]
        );

        /* Mandatory origin information */

        $rules->addCreate(function ($rat) {
                return $rat->hasBirthPlace();
            },
            'rattery_selected',
            [
                'errorField' => 'rattery_name',
                'message' => __('We could not find this rattery. Please, select it in the list or type an existing prefix.')
            ]
        );

        $rules->addCreate(function ($rat) {
                return $rat->hasValidOrigins();
            },
            'validOrigins',
            [
                'errorField' => 'origin_errors',
                'message' => __('Incomplete: mandatory information about origins are missing.
                <ul><li>For a generic origin (any origin but registered ratteries), please add relevant information in comments: name and location, circumstances of the rescue, etc.</li>
                <li>For a registered rattery, add at least a mother. Create her first if needed, or chose a generic origin.</li></ul>')
            ]
        );

        /* Mandatory physical traits */
        $rules->addCreate(function ($rat) {
                return isset($rat->color_id);
            },
            'hasColor',
            [
                'errorField' => 'color_id',
                'message' => __('Please select a color. If you don’t know what to chose, read documentation, or chose “Unknown” and add a picture for help.')
            ]
        );

        $rules->addCreate(function ($rat) {
                return isset($rat->coat_id);
            },
            'hasCoat',
            [
                'errorField' => 'coat_id',
                'message' => __('Please select a coat type.')
            ]
        );

        $rules->addCreate(function ($rat) {
                return isset($rat->dilution_id);
            },
            'hasDilution',
            [
                'errorField' => 'dilution_id',
                'message' => __('Please select a dilution type.')
            ]
        );

        $rules->addCreate(function ($rat) {
                return isset($rat->earset_id);
            },
            'hasEarset',
            [
                'errorField' => 'earset_id',
                'message' => __('Please select an earset.')
            ]
        );

        $rules->addCreate(function ($rat) {
                return isset($rat->eyecolor_id);
            },
            'hasEyecolor',
            [
                'errorField' => 'eyecolor_id',
                'message' => __('Please select an eyecolor.')
            ]
        );

        $rules->addCreate(function ($rat) {
                return isset($rat->marking_id);
            },
            'hasMarking',
            [
                'errorField' => 'marking_id',
                'message' => __('Please select a marking type.')
            ]
        );

        /* Picture when mandatory */
        $rules->addCreate(function ($rat) {
                return $rat->hasNeededPicture();
            },
            'hasNeededPicture',
            [
                'errorField' => 'picture_file',
                'message' => __('This rat’s variety is rare or often misidentified. Please upload a good quality picture for verification.')
            ]
        );

        /* Rules about death date and cause */

        $rules->add(function ($rat) {
            return ! $rat->isSherlockHolmes();
            },
            'isNotSherlockHolmes',
            [
                'errorField' => 'death_date',
                'message' => __('Death date is mandatory. If not known, please enter a best effort estimate.')
            ]
        );

        $rules->add(function ($rat) {
            return ! $rat->isBenjaminButton();
            },
            'isNotBenjaminButton',
            [
                'errorField' => 'death_date',
                'message' => __('Impossible: chosen death date is anterior to birth date. Please check and correct your entry.')
            ]
        );

        $rules->add(function ($rat) {
            return ! $rat->isMartyMcFly();
            },
            'isNotMartyMcFly',
            [
                'errorField' => 'death_date',
                'message' => __('Impossible: this date is in the future. Please check and correct your entry.')
            ]
        );

        $rules->add(function ($rat) {
            return ! $rat->isMathusalem();
            },
            [
                'errorField' => 'death_date',
                'message' => __('Impossible: it means that your rat would have lived more than {age} months, but rats do not live this long.', ['age' => RatsTable::MAXIMAL_AGE_MONTHS]),
            ]
        );

        $rules->add(function ($rat) {
                return $rat->canDieInfant();
            },
            'canDieInfant',
            [
                'errorField' => 'death_primary_cause_id',
                'message' => __('Impossible: your rat was too old at this date to die of “infant mortality”.')
            ]
        );

        $rules->add(function ($rat) {
                return $rat->canDieOldster();
            },
            'canDieOldster',
            [
                'errorField' => 'death_primary_cause_id',
                'message' => __('Impossible: your rat was too young at this date to die “from old age”.')
            ]
        );

        /* Sex change limitations */

        $rules->addUpdate(function ($rat) {
            return ! $rat->isTransParent();
            },
            'isTransParent',
            [
                'errorField' => 'sex',
                'message' => __('The sex of rats with registered offspring cannot be changed.')
            ]
        );

        return $rules;
    }

    /**
     * beforeSave method
     *
     *
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if (! $entity->isNew() && isset($entity->singularities)) {
            // if singularities were edited, the association must be fixed after snapshot was taken
            $model = \Cake\Datasource\FactoryLocator::get('Table')->get('Singularities');
            $swap_singularities = $entity->singularities;
            $entity->singularities = [];
            foreach ($swap_singularities as $swap_singularity) {
                $singularity = $model->get($swap_singularity['id']);
                array_push($entity->singularities, $singularity);
            }
            $entity->setDirty('singularities', true);
        }
    }

    /**
     * afterSave method
     *
     * Update litter count after adding a rat
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->isNew()) {
            // force pedigree_identifier writing
            $this->updateQuery()
                ->set(['pedigree_identifier' => $entity->pedigree_identifier])
                ->where(['id' => $entity->id])
                ->execute();

            // update litter count when relevant
            if (isset($entity->litter_id)) {
                $litters = \Cake\Datasource\FactoryLocator::get('Table')->get('Litters');
                $litters->removeBehavior('State');
                $litter = $litters->get($entity->litter_id);
                // explicitly pass litter id to by-pass States.is_reliable filtering
                $count = $litter->countMy('rats', 'litter', ['litter_id' => $litter->id]);
                if ($litter->pups_number < $count) {
                    $litter->pups_number = $litter->pups_number + 1;
                    $litters->save($litter, ['checkRules' => false, 'associated' => []]);
                }
                $litters->addBehavior('State');
            }
        }

        if (! $entity->is_alive && in_array('is_alive', $entity->getDirty())) {
            $death_event = new Event('Model.Rats.deceased', $entity, [
                'identity' => $this->Identity,
                //'previous_state' => $this->previous_state,
                //'new_state' => $this->new_state,
                'emitted' => $this->now,
                //'messages' => $this->messages,
                'messages' => [
                    [
                        'content' => __('{0} declared the death of this rat.', [$this->Identity->username]),
                        'is_automatically_generated' => true
                    ]
                ],
            ]);
            $this->getEventManager()->dispatch($death_event);
        }
    }

    /*
     * Finder functions
     */

    public function findSearchable(Query $query, array $options)
    {
        return $query->innerJoinWith('States', function ($q) {
            return $q->where(['is_searchable' => true]);
        });
    }

    public function findMultisearch(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        $options = $options['options'];

        // name
        if( !empty($options['namekey']) ) {
            $query->where([
                'OR' => [
                    'Rats.name LIKE' => '%'.$options['namekey'].'%',
                    'Rats.pup_name LIKE' => '%'.$options['namekey'].'%',
                ],
            ]);
        }

        // sex are checkboxes, cannot be empty
        // the only case where you have to filter is when sex_m and sex_f are different
        if ($options['sex_f'] xor $options['sex_m']) {
            $sexOption = $options['sex_f'] ? 'F' : 'M';
            $query->where([
                'Rats.sex IS' => $sexOption,
            ]);
        }

        // rattery
        if (!empty($options['rattery_id'])) {
            $query->where([
                'Rats.rattery_id IS' => $options['rattery_id'],
            ]);
        }

        // FIXME: dirty quickfix
        if (!empty($options['rattery_name'])) {
         $query
            ->contain('BirthLitters.Ratteries')
            ->where([
                'Ratteries.prefix IS' => substr($options['rattery_name'], 0, 3),
            ]);
        }

        // owner
        if (!empty($options['owner_user_id'])) {
            $query->where([
                'Rats.owner_user_id IS' => $options['owner_user_id'],
            ]);
        }

        // alive/dead are checkboxes, cannot be empty
        // the only case where you have to filter is when sex_m and sex_f are different
        if ($options['alive'] xor $options['deceased']) {
            $aliveOption = $options['alive'] ? true : false;
            $query->where([
                'Rats.is_alive IS' => $aliveOption,
            ]);
        }

        // dates
        if (!empty($options['birth_date_before'])) {
            $query->where([
                'Rats.birth_date <=' => $options['birth_date_before'],
            ]);
        }

        if( !empty($options['birth_date_after']) ) {
            $query->where([
                'Rats.birth_date >=' => $options['birth_date_after'],
            ]);
        }

        // Colors (multiple options authorized)
        if (!empty($options['colors'])) {
            $query->where([
                'Rats.color_id IN' => $options['colors'],
            ]);
        }

        // simple (hasOne) physical criteria
        if (!empty($options['eyecolor_id'])) {
            $query->where([
                'Rats.eyecolor_id IS' => $options['eyecolor_id'],
            ]);
        }
        if( !empty($options['dilution_id']) ) {
            $query->where([
                'Rats.dilution_id IS' => $options['dilution_id'],
            ]);
        }
        if( !empty($options['marking_id']) ) {
            $query->where([
                'Rats.marking_id IS' => $options['marking_id'],
            ]);
        }
        if (!empty($options['earset_id'])) {
            $query->where([
                'Rats.earset_id IS' => $options['earset_id'],
            ]);
        }
        if (!empty($options['coat_id'])) {
            $query->where([
                'Rats.coat_id IS' => $options['coat_id'],
            ]);
        }

        // singularities (belongToMany)
        if (!empty($options['singularity_id'])) {
            $query->matching('Singularities', function (\Cake\ORM\Query $query) use ($options) {
                return $query->where([
                    'Singularities.id' => $options['singularity_id'],
                ]);
            });
        }
        return $query->group(['Rats.id']);
    }

    public function findNamed(Query $query, array $options)
    {
        $columns = [
            'Rats.id', 'Rats.pedigree_identifier', 'Rats.is_pedigree_custom', 'Rats.name', 'Rats.pup_name', 'Rats.sex', 'Rats.is_alive',
            'Rats.rattery_id', 'Rats.owner_user_id', 'Rats.state_id', 'Rats.birth_date',
        ];

        $query = $query
            ->select()
            ->distinct();

        if (empty($options['names'])) {
            $query->where([
                'OR' => ['Rats.name IS' => null, 'Rats.pup_name IS' => NULL],
            ]);
        } else {
            // Find rats with parts of the string in that name
            $query->where([
                'OR' => [
                    'Rats.name LIKE' => '%'.implode($options['names']).'%',
                    'Rats.pup_name LIKE' => '%'.implode($options['names']).'%',
                ],
            ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findIdentified(Query $query, array $options)
    {
        $columns = [
            'Rats.id', 'Rats.pedigree_identifier', 'Rats.is_pedigree_custom', 'Rats.name', 'Rats.pup_name', 'Rats.sex', 'Rats.is_alive',
            'Rats.rattery_id', 'Rats.owner_user_id', 'Rats.state_id', 'Rats.birth_date',
        ];

        $query = $query
            ->select()
            ->distinct();

        if (empty($options['names'])) {
            $query->where([
                'OR' => ['Rats.name IS' => null, 'Rats.pup_name IS' => NULL],
            ]);
        } else {
            // Find rats with parts of the string in that name
            $query->where([
                'OR' => [
                    'Rats.name LIKE' => '%'.implode($options['names']).'%',
                    'Rats.pup_name LIKE' => '%'.implode($options['names']).'%',
                    'Rats.pedigree_identifier' => implode($options['names']),
                ],
            ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findIncipit(Query $query, array $options)
    {
        $columns = [
            'Rats.id', 'Rats.pedigree_identifier', 'Rats.is_pedigree_custom', 'Rats.name', 'Rats.pup_name', 'Rats.sex', 'Rats.is_alive',
            'Rats.rattery_id', 'Rats.owner_user_id', 'Rats.state_id', 'Rats.birth_date',
        ];

        $query = $query
            ->select()
            ->distinct();

        if (empty($options['names'])) {
            $query->where([
                'OR' => ['Rats.name IS' => null, 'Rats.pup_name IS' => NULL],
            ]);
        } else {
            // Find rats with parts of the string in that name
            $query->where([
                'OR' => [
                    'Rats.name LIKE' => implode($options['names']).'%',
                    'Rats.pedigree_identifier LIKE' => implode($options['names']).'%',
                ],
            ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findFromRattery(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['ratteries'])) {
            $query->leftJoinWith('Ratteries')
                  ->where([
                      'OR' => ['Ratteries.name IS' => null, 'Ratteries.prefix IS' => NULL],
                  ]);
        } else {
            // Find articles that have one or more of the provided tags.
            $query->innerJoinWith('Ratteries')
                  ->where([
                      'OR' => [
                          'Ratteries.name LIKE' => '%'.implode($options['ratteries']).'%',
                          'Ratteries.prefix LIKE' => '%'.implode($options['ratteries']).'%',
                      ],
                  ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findByRatteryId(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['ratteries'])) {
            $query->leftJoinWith('Ratteries')
                  ->where([
                      'Ratteries.id IS' => null,
                  ]);
        } else {
            $query->innerJoinWith('Ratteries')
                  ->where(['Ratteries.id' => implode($options['ratteries'])]);
        }

        return $query->group(['Rats.id']);
    }

    public function findOwnedBy(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['owners'])) {
            $query->leftJoinWith('OwnerUsers')
                  ->where([
                      'OwnerUsers.username IS' => null,
                  ]);
        } else {
            $query->innerJoinWith('OwnerUsers')
                  ->where([
                          'OwnerUsers.username LIKE' => '%'.implode($options['owners']).'%',
                ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findByOwnerId(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['owners'])) {
            $query->leftJoinWith('OwnerUsers')
                  ->where([
                      'OwnerUsers.id IS' => null,
                  ]);
        } else {
            $query->innerJoinWith('OwnerUsers')
                  ->where([
                          'OwnerUsers.id' => implode($options['owners']),
                ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findEntitledBy(Query $query, array $options)
    {
        $query = $query
            ->select('id')
            ->distinct();

        if (empty($options['user_id'])) {
            $query->leftJoinWith('OwnerUsers')
                  ->leftJoinWith('CreatorUsers')
                  ->where([
                      'CreatorUsers.id IS' => null,
                      'OwnerUsers.id IS' => null,
                  ]);
        } else {
            $query->innerJoinWith('OwnerUsers')
                  ->innerJoinWith('CreatorUsers')
                  ->where(['OR' => [
                      'CreatorUsers.id' => $options['user_id'],
                      'OwnerUsers.id' => $options['user_id'],
                  ],
                ]);
        }
        return $query->group(['Rats.id']);
    }

    public function findSex(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['sex'])) {
            $query->where([
                'Rats.sex IS' => null,
            ]);
        } else {
            $query->where([
                'Rats.sex IN' => ($options['sex']),
            ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findBornBefore(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['bornBefore'])) {
            $query->where([
                'Rats.birth_date IS' => null,
            ]);
        } else {
            // Find rats with birthdates before passed parameter
            $bornBefore = implode($options['bornBefore']);
            // concatenate with  . " 00:00:00.000" ??
            $query->where([
                    'Rats.birth_date <=' => $bornBefore,
            ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findBornAfter(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['bornAfter'])) {
            $query->where([
                'Rats.birth_date IS' => null,
            ]);
        } else {
            // Find rats with birthdates posterior to passed parameter
            $bornAfter = implode($options['bornAfter']);
            // concatenate with  . " 00:00:00.000" ??
            $query->where([
                    'Rats.birth_date >=' => $bornAfter,
            ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findInState(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['inState'])) {
            $query->where([
                'Rats.state_id IS' => null,
            ]);
        } else {
            $inState = implode($options['inState']);
            $query->where([
                    'Rats.state_id IS' => $inState,
            ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findNeedsStaff(Query $query, array $options)
    {
        return $query
            ->select()
            ->distinct()
            ->where(['States.needs_staff_action IS' => true])
            ->contain(['States', 'DeathPrimaryCauses', 'DeathSecondaryCauses'])
            ->group(['Rats.id']);
    }

    public function findNeedsUser(Query $query, array $options)
    {
        return $query
            ->select()
            ->distinct()
            ->where(['States.needs_user_action IS' => true])
            ->contain(['States', 'DeathPrimaryCauses', 'DeathSecondaryCauses'])
            ->group(['Rats.id']);
    }

    public function findMales(Query $query, array $options)
    {
        return $query
            ->where([
                'sex' => 'M'
            ])
            ->contain(['Ratteries', 'Singularities']);
    }

    public function findFemales(Query $query, array $options)
    {
        return $query
            ->where([
                'sex' => 'F'
            ])
            ->contain(['Ratteries', 'Singularities']);
    }

    public function findZombies(Query $query, array $options)
    {
        return $query
            ->where([
                'is_alive IS' => true,
                'DATEDIFF(NOW(), birth_date) >' => self::MAXIMAL_AGE
            ]);
    }

    // default death cause is hardcoded, should be configured as 'is_default' in corresponding tables
    public function killZombies() {
        $count = $this->find('zombies')->count();

        if ($count > 0) {
            $query = $this->find('zombies');
            $comment = __('**This sheet was automatically updated to set the rat as dead, as it was too old to be still alive.**');
            $this
                ->updateQuery()
                ->where([
                    'id IN' => $query->all()->extract('id')->toArray()
                ])
                ->set([
                    'is_alive' => false,
                    'death_date' => \Cake\I18n\FrozenTime::now(),
                    'death_primary_cause_id' => '1',
                    'death_secondary_cause_id' => '1',
                    'death_euthanized' => '0',
                    'death_diagnosed' => '0',
                    'death_necropsied' => '0',
                    'comments' => $query->func()->concat([
                        $query->func()->coalesce(['comments' => 'identifier', '']),
                        'CHAR (10)' => 'identifier',
                        'CHAR (13)' => 'identifier',
                        $comment
                    ]),
                ])
                ->execute();
            }

        return $count;
    }
}
