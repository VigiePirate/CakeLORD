<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeathCausesSecondary Model
 *
 * @property \App\Model\Table\DeathCausesPrimaryTable&\Cake\ORM\Association\BelongsTo $DeathCausesPrimary
 *
 * @method \App\Model\Entity\DeathCausesSecondary get($primaryKey, $options = [])
 * @method \App\Model\Entity\DeathCausesSecondary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DeathCausesSecondary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeathCausesSecondary|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeathCausesSecondary saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeathCausesSecondary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DeathCausesSecondary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeathCausesSecondary findOrCreate($search, callable $callback = null, $options = [])
 */
class DeathCausesSecondaryTable extends Table
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

        $this->setTable('death_causes_secondary');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('DeathCausesPrimary', [
            'foreignKey' => 'deces_principal_id',
            'joinType' => 'INNER',
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
            ->scalar('name_fr')
            ->maxLength('name_fr', 100)
            ->allowEmptyString('name_fr');

        $validator
            ->scalar('name_en')
            ->maxLength('name_en', 100)
            ->allowEmptyString('name_en');

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
        $rules->add($rules->existsIn(['deces_principal_id'], 'DeathCausesPrimary'));

        return $rules;
    }
}
