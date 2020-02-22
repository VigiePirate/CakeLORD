<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeathPrimaryCauses Model
 *
 * @property \App\Model\Table\DeathSecondaryCausesTable&\Cake\ORM\Association\HasMany $DeathSecondaryCauses
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 *
 * @method \App\Model\Entity\DeathPrimaryCause get($primaryKey, $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeathPrimaryCause findOrCreate($search, callable $callback = null, $options = [])
 */
class DeathPrimaryCausesTable extends Table
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

        $this->setTable('death_primary_causes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('DeathSecondaryCauses', [
            'foreignKey' => 'death_primary_cause_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'death_primary_cause_id',
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
}
