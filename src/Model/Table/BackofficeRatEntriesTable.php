<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BackofficeRatEntries Model
 *
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\BelongsTo $Rats
 * @property \App\Model\Table\ColorsTable&\Cake\ORM\Association\BelongsTo $Colors
 * @property \App\Model\Table\EarsetsTable&\Cake\ORM\Association\BelongsTo $Earsets
 * @property \App\Model\Table\EyecolorsTable&\Cake\ORM\Association\BelongsTo $Eyecolors
 * @property \App\Model\Table\DilutionsTable&\Cake\ORM\Association\BelongsTo $Dilutions
 * @property \App\Model\Table\CoatsTable&\Cake\ORM\Association\BelongsTo $Coats
 * @property \App\Model\Table\MarkingsTable&\Cake\ORM\Association\BelongsTo $Markings
 * @property \App\Model\Table\BackofficeRatMessagesTable&\Cake\ORM\Association\HasMany $BackofficeRatMessages
 *
 * @method \App\Model\Entity\BackofficeRatEntry get($primaryKey, $options = [])
 * @method \App\Model\Entity\BackofficeRatEntry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BackofficeRatEntry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatEntry|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BackofficeRatEntry saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BackofficeRatEntry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatEntry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatEntry findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BackofficeRatEntriesTable extends Table
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

        $this->setTable('backoffice_rat_entries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Rats', [
            'foreignKey' => 'rat_id',
        ]);
        $this->belongsTo('PrimaryDeathCauses', [
            'foreignKey' => 'primary_death_cause_id',
        ]);
        $this->belongsTo('SecondaryDeathCauses', [
            'foreignKey' => 'secondary_death_cause_id',
        ]);
        $this->belongsTo('MotherRatteries', [
            'foreignKey' => 'mother_rattery_id',
        ]);
        $this->belongsTo('FatherRatteries', [
            'foreignKey' => 'father_rattery_id',
        ]);
        $this->belongsTo('MotherRats', [
            'foreignKey' => 'mother_rat_id',
        ]);
        $this->belongsTo('FatherRats', [
            'foreignKey' => 'father_rat_id',
        ]);
        $this->belongsTo('OwnerUsers', [
            'foreignKey' => 'owner_user_id',
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
        $this->belongsTo('CreatorUsers', [
            'foreignKey' => 'creator_user_id',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('BackofficeRatMessages', [
            'foreignKey' => 'backoffice_rat_entry_id',
        ]);
        $this->belongsToMany('Singularities', [
            'foreignKey' => 'backoffice_rat_entry_id',
            'targetForeignKey' => 'singularity_id',
            'joinTable' => 'backoffice_rat_entries_singularities',
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
            ->scalar('owner_name')
            ->maxLength('owner_name', 70)
            ->allowEmptyString('owner_name');

        $validator
            ->scalar('pup_name')
            ->maxLength('pup_name', 70)
            ->allowEmptyString('pup_name');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 1)
            ->allowEmptyString('sex');

        $validator
            ->scalar('pedigree_identifier')
            ->maxLength('pedigree_identifier', 10)
            ->allowEmptyString('pedigree_identifier');

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
        $rules->add($rules->existsIn(['rat_id'], 'Rats'));
        $rules->add($rules->existsIn(['primary_death_cause_id'], 'PrimaryDeathCauses'));
        $rules->add($rules->existsIn(['secondary_death_cause_id'], 'SecondaryDeathCauses'));
        $rules->add($rules->existsIn(['mother_rattery_id'], 'MotherRatteries'));
        $rules->add($rules->existsIn(['father_rattery_id'], 'FatherRatteries'));
        $rules->add($rules->existsIn(['mother_rat_id'], 'MotherRats'));
        $rules->add($rules->existsIn(['father_rat_id'], 'FatherRats'));
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
