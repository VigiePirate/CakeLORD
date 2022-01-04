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
use Cake\Collection\Collection;

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
 * @property \App\Model\Table\ConversationsTable&\Cake\ORM\Association\HasMany $Conversations
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
        $this->addBehavior('Snapshot', [
            'repository' => 'RatSnapshots',
            'entityField' => 'rat_id',
        ]);
        $this->addBehavior('State', [
            'safe_properties' => ['name', 'pup_name'],
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
        $this->hasMany('Conversations', [
            'foreignKey' => 'rat_id',
        ]);
        $this->hasMany('RatSnapshots', [
            'foreignKey' => 'rat_id',
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

        /* No rat born in the future */
        $rules->add(function ($rat) {
                return ! $rat->isBornFuture();
            },
            'bornFuture',
            [
                'errorField' => 'birth_date',
                'message' => 'Impossible: this date is in the future.'
            ]
        );

        /* Rules about death date and cause */
        $timeline = function($rat) {
            return !( !$rat->is_alive && $rat->birth_date->isFuture($rat->death_date) );
        };
        $rules->add($timeline, [
            'errorField' => 'death_date',
            'message' => 'Impossible: chosen death date is anterior to birth date. Please check and correct your entry.'
        ]);

        // temporary test for dead rats without death date (should not exist but...)
        $future = function($rat) {
            return !( !$rat->is_alive && !is_null($rat->death_date) && $rat->death_date->isFuture() );
        };
        $rules->add($future, [
            'errorField' => 'death_date',
            'message' => 'Impossible: this date is in the future. Please check and correct your entry.'
        ]);

        $mathusalem = function($rat) {
            return !( !$rat->is_alive && $rat->age > 54);
        };
        $rules->add($mathusalem, [
            'errorField' => 'death_date',
            'message' => 'Impossible: it means that your rat would have lived more than 4 years and a half, but rats do not live this long.'
        ]);

        $infant = function($rat) {
            return ! ( !$rat->is_alive && ($rat->death_primary_cause->is_infant) && ($rat->precise_age > 42) );
        };
        $rules->add($infant, [
            'errorField' => 'death_primary_cause_id',
            'message' => 'Impossible: your rat was too old at this date to die of “infant mortality”.'
        ]);

        $oldster = function($rat) {
            return !( !$rat->is_alive && ($rat->death_primary_cause->is_oldster) && ($rat->age < 24) );
        };
        $rules->add($oldster, [
            'errorField' => 'death_primary_cause_id',
            'message' => 'Impossible: your rat was too young at this date to die “from old age”.'
        ]);

        return $rules;
    }

    public function afterMarshal(EventInterface $event, EntityInterface $entity, ArrayObject $data, ArrayObject $options)
    {
        if ($entity->hasUnchangedBirthDate()) {
            $entity->setDirty('birth_date', false);
        }
        if ($entity->hasUnchangedSingularities()) {
            $entity->setDirty('singularities', false);
        }
    }

    /*
     * Finder functions
     */

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
         if( $options['sex_f'] xor $options['sex_m']) {
             $sexOption = $options['sex_f'] ? 'F' : 'M';
             $query->where([
                 'Rats.sex IS' => $sexOption,
             ]);
         }

         // rattery
         if( !empty($options['rattery_id']) ) {
             $query->where([
                 'Rats.rattery_id IS' => $options['rattery_id'],
             ]);
         }

         // owner
         if( !empty($options['owner_user_id']) ) {
             $query->where([
                 'Rats.owner_user_id IS' => $options['owner_user_id'],
             ]);
         }

         // alive/dead are checkboxes, cannot be empty
         // the only case where you have to filter is when sex_m and sex_f are different
         if( $options['alive'] xor $options['deceased']) {
             $aliveOption = $options['alive'] ? true : false;
             $query->where([
                 'Rats.is_alive IS' => $aliveOption,
             ]);
         }

         // dates
         if( !empty($options['birth_date_before']) ) {
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
         if( !empty($options['colors']) ) {
             $query->where([
                 'Rats.color_id IN' => $options['colors'],
             ]);
         }

         // simple (hasOne) physical criteria
         if( !empty($options['eyecolor_id']) ) {
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
         if( !empty($options['earset_id']) ) {
             $query->where([
                 'Rats.earset_id IS' => $options['earset_id'],
             ]);
         }
         if( !empty($options['coat_id']) ) {
             $query->where([
                 'Rats.coat_id IS' => $options['coat_id'],
             ]);
         }

         // singularities (belongToMany)
         if( !empty($options['singularity_id']) ) {
             $query->matching('Singularities', function (\Cake\ORM\Query $query) use ($options) {
                 return $query->where([
                     'Singularities.id' => $options['singularity_id'],
                 ]);
             });
         }
         return $query->group(['Rats.id']);
     }

/* queries */
// colors
// singularity_id

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
                    'Rats.name LIKE' => implode($options['names']).'%',
                    'Rats.pedigree_identifier LIKE' => '%'.implode($options['names']).'%',
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
            // Find articles that have one or more of the provided tags.
            $query->innerJoinWith('OwnerUsers')
                  ->where([
                          'OwnerUsers.username LIKE' => '%'.implode($options['owners']).'%',
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
            // Find rats with parts of the string in that name
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
            // Find rats with birthdates posterior to passed parameter
            $inState = implode($options['inState']);
            // concatenate with  . " 00:00:00.000" ??
            $query->where([
                    'Rats.state_id IS' => $inState,
            ]);
        }

        return $query->group(['Rats.id']);
    }

    public function findMales(Query $query, array $options)
    {
        return $query
            ->where([
                'sex' => 'M'
            ])
            ->contain(['Ratteries']);
    }

    public function findFemales(Query $query, array $options)
    {
        return $query
            ->where([
                'sex' => 'F'
            ])
            ->contain(['Ratteries']);
    }
}
