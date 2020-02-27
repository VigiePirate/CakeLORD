<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RatsLitters Model
 *
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\BelongsTo $Rats
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsTo $Litters
 *
 * @method \App\Model\Entity\RatsLitter newEmptyEntity()
 * @method \App\Model\Entity\RatsLitter newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RatsLitter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RatsLitter get($primaryKey, $options = [])
 * @method \App\Model\Entity\RatsLitter findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RatsLitter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RatsLitter[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RatsLitter|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatsLitter saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatsLitter[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatsLitter[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatsLitter[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatsLitter[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RatsLittersTable extends Table
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

        $this->setTable('rats_litters');
        $this->setDisplayField('rat_id');
        $this->setPrimaryKey(['rat_id', 'litter_id']);

        $this->belongsTo('Rats', [
            'foreignKey' => 'rat_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Litters', [
            'foreignKey' => 'litter_id',
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
        $rules->add($rules->existsIn(['rat_id'], 'Rats'));
        $rules->add($rules->existsIn(['litter_id'], 'Litters'));

        return $rules;
    }
}
