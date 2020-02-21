<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeathCausesPrimary Model
 *
 * @method \App\Model\Entity\DeathCausesPrimary get($primaryKey, $options = [])
 * @method \App\Model\Entity\DeathCausesPrimary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DeathCausesPrimary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeathCausesPrimary|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeathCausesPrimary saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeathCausesPrimary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DeathCausesPrimary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeathCausesPrimary findOrCreate($search, callable $callback = null, $options = [])
 */
class DeathCausesPrimaryTable extends Table
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

        $this->setTable('death_causes_primary');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
