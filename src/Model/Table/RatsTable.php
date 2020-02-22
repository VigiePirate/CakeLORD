<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rats Model
 *
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsTo $Litters
 * @property \App\Model\Table\ColorsTable&\Cake\ORM\Association\BelongsTo $Colors
 * @property \App\Model\Table\EarsetsTable&\Cake\ORM\Association\BelongsTo $Earsets
 * @property \App\Model\Table\EyecolorsTable&\Cake\ORM\Association\BelongsTo $Eyecolors
 * @property \App\Model\Table\DilutionsTable&\Cake\ORM\Association\BelongsTo $Dilutions
 * @property \App\Model\Table\CoatsTable&\Cake\ORM\Association\BelongsTo $Coats
 * @property \App\Model\Table\MarkingsTable&\Cake\ORM\Association\BelongsTo $Markings
 * @property \App\Model\Table\BackofficeRatEntriesTable&\Cake\ORM\Association\HasMany $BackofficeRatEntries
 * @property \App\Model\Table\SingularitiesTable&\Cake\ORM\Association\BelongsToMany $Singularities
 *
 * @method \App\Model\Entity\Rat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rat newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rat[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rat findOrCreate($search, callable $callback = null, $options = [])
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
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('DeathPrimaryCauses', [
            'foreignKey' => 'death_primary_cause_id',
        ]);
        $this->belongsTo('DeathSecondaryCauses', [
            'foreignKey' => 'death_secondary_cause_id',
        ]);
        $this->belongsTo('Ratteries', [
            'className' => 'Ratteries',
            'foreignKey' => 'rattery_id',
            'propertyName' => 'mother_rattery_id'
        ]);
        $this->belongsTo('Ratteries', [
            'foreignKey' => 'father_rattery_id',
        ]);
        $this->belongsTo('Rats', [
            'foreignKey' => 'rat_id', // mother_rat_id
        ]);
        $this->belongsTo('Rats', [
            'foreignKey' => 'father_rat_id',
        ]);
        $this->belongsTo('Litters', [
            'foreignKey' => 'litter_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id', // owner_user_id
        ]);
        $this->belongsTo('Colors', [
            'foreignKey' => 'color_id',
        ]);
        $this->belongsTo('Earsets', [
            'foreignKey' => 'earset_id',
        ]);
        $this->belongsTo('Eyecolors', [
            'foreignKey' => 'eyecolor_id',
        ]);
        $this->belongsTo('Dilutions', [
            'foreignKey' => 'dilution_id',
        ]);
        $this->belongsTo('Coats', [
            'foreignKey' => 'coat_id',
        ]);
        $this->belongsTo('Markings', [
            'foreignKey' => 'marking_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'creator_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('BackofficeRatEntries', [
            'foreignKey' => 'rat_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name_owner')
            ->maxLength('name_owner', 70)
            ->allowEmptyString('name_owner');

        $validator
            ->scalar('name_pup')
            ->maxLength('name_pup', 70)
            ->allowEmptyString('name_pup');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 1)
            ->requirePresence('sex', 'create')
            ->notEmptyString('sex');

        $validator
            ->scalar('pedigree_identifier')
            ->maxLength('pedigree_identifier', 10)
            ->allowEmptyString('pedigree_identifier')
            ->add('pedigree_identifier', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->date('birth_date')
            ->allowEmptyDate('birth_date');

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
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->allowEmptyString('picture');

        $validator
            ->scalar('picture_thumbnail')
            ->maxLength('picture_thumbnail', 255)
            ->allowEmptyString('picture_thumbnail');

        $validator
            ->scalar('comments')
            ->allowEmptyString('comments');

        $validator
            ->boolean('validated')
            ->allowEmptyString('validated');

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
        $rules->add($rules->isUnique(['pedigree_identifier']));
        $rules->add($rules->existsIn(['death_primary_cause_id'], 'DeathPrimaryCauses'));
        $rules->add($rules->existsIn(['death_secondary_cause_id'], 'DeathSecondaryCauses'));
        $rules->add($rules->existsIn(['mother_rattery_id'], 'MotherRatteries'));
        $rules->add($rules->existsIn(['father_rattery_id'], 'FatherRatteries'));
        $rules->add($rules->existsIn(['mother_rat_id'], 'MotherRats'));
        $rules->add($rules->existsIn(['father_rat_id'], 'FatherRats'));
        $rules->add($rules->existsIn(['litter_id'], 'Litters'));
        $rules->add($rules->existsIn(['owner_user_id'], 'OwnerUsers'));
        $rules->add($rules->existsIn(['color_id'], 'Colors'));
        $rules->add($rules->existsIn(['earset_id'], 'Earsets'));
        $rules->add($rules->existsIn(['eyecolor_id'], 'Eyecolors'));
        $rules->add($rules->existsIn(['dilution_id'], 'Dilutions'));
        $rules->add($rules->existsIn(['coat_id'], 'Coats'));
        $rules->add($rules->existsIn(['marking_id'], 'Markings'));
        $rules->add($rules->existsIn(['creator_user_id'], 'CreatorUsers'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
