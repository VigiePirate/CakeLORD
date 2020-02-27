<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LittersRats Model
 *
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsTo $Litters
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\BelongsTo $Rats
 *
 * @method \App\Model\Entity\LittersRat newEmptyEntity()
 * @method \App\Model\Entity\LittersRat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LittersRat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LittersRat get($primaryKey, $options = [])
 * @method \App\Model\Entity\LittersRat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LittersRat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LittersRat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LittersRat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LittersRat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LittersRat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LittersRat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LittersRat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LittersRat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LittersRatsTable extends Table
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

        $this->setTable('litters_rats');
        $this->setDisplayField('litters_id');
        $this->setPrimaryKey(['litters_id', 'rats_id']);

        $this->belongsTo('Litters', [
            'foreignKey' => 'litters_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Rats', [
            'foreignKey' => 'rats_id',
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
        $rules->add($rules->existsIn(['litters_id'], 'Litters'));
        $rules->add($rules->existsIn(['rats_id'], 'Rats'));

        return $rules;
    }
}
