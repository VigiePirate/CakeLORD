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
 * @property \App\Model\Table\DeathCausesPrimaryTable&\Cake\ORM\Association\BelongsTo $DeathCausesPrimary
 * @property \App\Model\Table\DeathCausesSecondaryTable&\Cake\ORM\Association\BelongsTo $DeathCausesSecondary
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsTo $Ratteries
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsTo $Ratteries
 * @property \App\Model\Table\BackofficeRatEntriesTable&\Cake\ORM\Association\BelongsTo $BackofficeRatEntries
 * @property \App\Model\Table\BackofficeRatEntriesTable&\Cake\ORM\Association\BelongsTo $BackofficeRatEntries
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ColorsTable&\Cake\ORM\Association\BelongsTo $Colors
 * @property \App\Model\Table\EarsetsTable&\Cake\ORM\Association\BelongsTo $Earsets
 * @property \App\Model\Table\EyecolorsTable&\Cake\ORM\Association\BelongsTo $Eyecolors
 * @property \App\Model\Table\DilutionsTable&\Cake\ORM\Association\BelongsTo $Dilutions
 * @property \App\Model\Table\CoatsTable&\Cake\ORM\Association\BelongsTo $Coats
 * @property \App\Model\Table\MarkingsTable&\Cake\ORM\Association\BelongsTo $Markings
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
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

        $this->belongsTo('Rats', [
            'foreignKey' => 'rat_id',
        ]);
        $this->belongsTo('DeathCausesPrimary', [
            'foreignKey' => 'death_cause_primary_id',
        ]);
        $this->belongsTo('DeathCausesSecondary', [
            'foreignKey' => 'death_cause_secondary_id',
        ]);
        $this->belongsTo('Ratteries', [
            'foreignKey' => 'rattery_mother_id',
        ]);
        $this->belongsTo('Ratteries', [
            'foreignKey' => 'rattery_father_id',
        ]);
        $this->belongsTo('BackofficeRatEntries', [
            'foreignKey' => 'rat_mother_id',
        ]);
        $this->belongsTo('BackofficeRatEntries', [
            'foreignKey' => 'rat_father_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_owner_id',
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
            'foreignKey' => 'user_creator_id',
        ]);
        $this->hasMany('BackofficeRatMessages', [
            'foreignKey' => 'backoffice_rat_entry_id',
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
            ->allowEmptyString('id', null, 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmptyString('status');

        $validator
            ->scalar('rat_name_owner')
            ->maxLength('rat_name_owner', 70)
            ->allowEmptyString('rat_name_owner');

        $validator
            ->scalar('rat_name_pup')
            ->maxLength('rat_name_pup', 70)
            ->allowEmptyString('rat_name_pup');

        $validator
            ->scalar('rat_sex')
            ->maxLength('rat_sex', 1)
            ->allowEmptyString('rat_sex');

        $validator
            ->scalar('rat_pedigree_identifier')
            ->maxLength('rat_pedigree_identifier', 10)
            ->allowEmptyString('rat_pedigree_identifier');

        $validator
            ->date('rat_date_birth')
            ->allowEmptyDate('rat_date_birth');

        $validator
            ->date('rat_date_death')
            ->allowEmptyDate('rat_date_death');

        $validator
            ->boolean('rat_death_euthanized')
            ->allowEmptyString('rat_death_euthanized');

        $validator
            ->boolean('rat_death_diagnosed')
            ->allowEmptyString('rat_death_diagnosed');

        $validator
            ->boolean('rat_death_necropsied')
            ->allowEmptyString('rat_death_necropsied');

        $validator
            ->scalar('rat_picture')
            ->maxLength('rat_picture', 255)
            ->allowEmptyString('rat_picture');

        $validator
            ->scalar('rat_picture_thumbnail')
            ->maxLength('rat_picture_thumbnail', 255)
            ->allowEmptyString('rat_picture_thumbnail');

        $validator
            ->scalar('rat_comments')
            ->allowEmptyString('rat_comments');

        $validator
            ->allowEmptyString('rat_validated');

        $validator
            ->scalar('singularity_id_list')
            ->maxLength('singularity_id_list', 15)
            ->allowEmptyString('singularity_id_list');

        $validator
            ->date('rat_date_create')
            ->allowEmptyDate('rat_date_create');

        $validator
            ->date('rat_date_last_update')
            ->allowEmptyDate('rat_date_last_update');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['rat_id'], 'Rats'));
        $rules->add($rules->existsIn(['death_cause_primary_id'], 'DeathCausesPrimary'));
        $rules->add($rules->existsIn(['death_cause_secondary_id'], 'DeathCausesSecondary'));
        $rules->add($rules->existsIn(['rattery_mother_id'], 'Ratteries'));
        $rules->add($rules->existsIn(['rattery_father_id'], 'Ratteries'));
        $rules->add($rules->existsIn(['rat_mother_id'], 'BackofficeRatEntries'));
        $rules->add($rules->existsIn(['rat_father_id'], 'BackofficeRatEntries'));
        $rules->add($rules->existsIn(['user_owner_id'], 'Users'));
        $rules->add($rules->existsIn(['color_id'], 'Colors'));
        $rules->add($rules->existsIn(['earset_id'], 'Earsets'));
        $rules->add($rules->existsIn(['eyecolor_id'], 'Eyecolors'));
        $rules->add($rules->existsIn(['dilution_id'], 'Dilutions'));
        $rules->add($rules->existsIn(['coat_id'], 'Coats'));
        $rules->add($rules->existsIn(['marking_id'], 'Markings'));
        $rules->add($rules->existsIn(['user_creator_id'], 'Users'));

        return $rules;
    }
}
