<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RatsSingularities Model
 *
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\BelongsTo $Rats
 * @property \App\Model\Table\SingularitiesTable&\Cake\ORM\Association\BelongsTo $Singularities
 *
 * @method \App\Model\Entity\RatsSingularity get($primaryKey, $options = [])
 * @method \App\Model\Entity\RatsSingularity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RatsSingularity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RatsSingularity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatsSingularity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatsSingularity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RatsSingularity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RatsSingularity findOrCreate($search, callable $callback = null, $options = [])
 */
class RatsSingularitiesTable extends Table
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

        $this->setTable('rats_singularities');
        $this->setDisplayField('rats_id');
        $this->setPrimaryKey(['rats_id', 'singularities_id']);

        $this->belongsTo('Rats', [
            'foreignKey' => 'rats_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Singularities', [
            'foreignKey' => 'singularities_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['rats_id'], 'Rats'));
        $rules->add($rules->existsIn(['singularities_id'], 'Singularities'));

        return $rules;
    }
}
