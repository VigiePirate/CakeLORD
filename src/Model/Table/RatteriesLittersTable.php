<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RatteriesLitters Model
 *
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsTo $Ratteries
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsTo $Litters
 * @property \App\Model\Table\LittersContributionsTable&\Cake\ORM\Association\BelongsTo $LittersContributions
 *
 * @method \App\Model\Entity\RatteriesLitter newEmptyEntity()
 * @method \App\Model\Entity\RatteriesLitter newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RatteriesLitter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RatteriesLitter get($primaryKey, $options = [])
 * @method \App\Model\Entity\RatteriesLitter findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RatteriesLitter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RatteriesLitter[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RatteriesLitter|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatteriesLitter saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatteriesLitter[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatteriesLitter[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatteriesLitter[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatteriesLitter[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RatteriesLittersTable extends Table
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

        $this->setTable('ratteries_litters');
        $this->setDisplayField('rattery_id');
        $this->setPrimaryKey(['rattery_id', 'litter_id']);

        $this->belongsTo('Ratteries', [
            'foreignKey' => 'rattery_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Litters', [
            'foreignKey' => 'litter_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('LittersContributions', [
            'foreignKey' => 'litters_contribution_id',
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
        $rules->add($rules->existsIn(['rattery_id'], 'Ratteries'));
        $rules->add($rules->existsIn(['litter_id'], 'Litters'));
        $rules->add($rules->existsIn(['litters_contribution_id'], 'LittersContributions'));

        return $rules;
    }
}
