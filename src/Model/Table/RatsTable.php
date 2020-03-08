<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;

/**
 * Rats Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsTo $Ratteries
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
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsToMany $Litters
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsToMany $Litters
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
        $this->setDisplayField('pedigree_identifier');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('OwnerUsers', [
            'className' => 'Users',
            'foreignKey' => 'owner_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Ratteries', [
            'foreignKey' => 'rattery_id',
            'joinType' => 'INNER',
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
        $this->belongsToMany('Litters', [
            'foreignKey' => 'rat_id',
            'targetForeignKey' => 'litter_id',
            'joinTable' => 'litters_rats',
        ]);
        $this->belongsToMany('Litters', [
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

        return $rules;
    }

    /*
     * Finder functions
     */
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
            // Find rats with parts of the string in that name
          $bornBefore = ($options['bornBefore']) . " 00:00:00.000";
            $query->where([
                    'Rats.birth_date <=' => ($bornBefore),
            ]);
        }

        return $query->group(['Rats.id']);
    }

}
