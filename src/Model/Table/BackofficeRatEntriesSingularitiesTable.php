<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BackofficeRatEntriesSingularities Model
 *
 * @property \App\Model\Table\BackofficeRatEntriesTable&\Cake\ORM\Association\BelongsTo $BackofficeRatEntries
 * @property \App\Model\Table\SingularitiesTable&\Cake\ORM\Association\BelongsTo $Singularities
 *
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity get($primaryKey, $options = [])
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity findOrCreate($search, callable $callback = null, $options = [])
 */
class BackofficeRatEntriesSingularitiesTable extends Table
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

        $this->setTable('backoffice_rat_entries_singularities');
        $this->setDisplayField('backoffice_rat_entries_id');
        $this->setPrimaryKey(['backoffice_rat_entries_id', 'singularities_id']);

        $this->belongsTo('BackofficeRatEntries', [
            'foreignKey' => 'backoffice_rat_entries_id',
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
        $rules->add($rules->existsIn(['backoffice_rat_entries_id'], 'BackofficeRatEntries'));
        $rules->add($rules->existsIn(['singularities_id'], 'Singularities'));

        return $rules;
    }
}
