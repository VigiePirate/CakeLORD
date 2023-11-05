<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LitterMessages Model
 *
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsTo $Litters
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\LitterMessage newEmptyEntity()
 * @method \App\Model\Entity\LitterMessage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LitterMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LitterMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\LitterMessage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LitterMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LitterMessage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LitterMessage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LitterMessage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LitterMessage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LitterMessage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LitterMessage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LitterMessage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LitterMessagesTable extends Table
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

        $this->setTable('litter_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Litters', [
            'foreignKey' => 'litter_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'from_user_id',
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
            ->nonNegativeInteger('litter_id')
            ->notEmptyString('litter_id');

        $validator
            ->nonNegativeInteger('from_user_id')
            ->notEmptyString('from_user_id');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        $validator
            ->boolean('is_staff_request')
            ->notEmptyString('is_staff_request');

        $validator
            ->boolean('is_automatically_generated')
            ->notEmptyString('is_automatically_generated');

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
        $rules->add($rules->existsIn('litter_id', 'Litters'), ['errorField' => 'litter_id']);
        $rules->add($rules->existsIn('from_user_id', 'Users'), ['errorField' => 'from_user_id']);

        return $rules;
    }

    public function findEntitled(Query $query, array $options) {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['user_id'])) {
            $query->leftJoinWith('Litters')
                ->where(['creator_user_id' => null]);
        } else {
            $query->innerJoinWith('Litters')
                ->where(['creator_user_id' => $options['user_id']]);
        }

        return $query->group(['Litters.id']);
    }

    public function findLatest(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['user_id']) || empty($options['delay'])) {
            return $query;
        } else {
            $filter = [
                'creator_user_id' => $options['user_id'],
                'LitterMessages.created >=' => $options['delay']
            ];
        }

        $query
            ->order('LitterMessages.created DESC')
            ->contain([
                'Litters',
                'Litters.Contributions',
                'Litters.Sire',
                'Litters.Dam',
                'Litters.LitterMessages' => ['sort' => 'LitterMessages.created DESC'],
                'Litters.Users',
                'Litters.States',
                'Users'
            ])
            ->where($filter);

        return $query;
    }
}
