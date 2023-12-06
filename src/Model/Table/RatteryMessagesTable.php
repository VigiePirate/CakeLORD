<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RatteryMessages Model
 *
 * @property \App\Model\Table\RatteriesTable&\Cake\ORM\Association\BelongsTo $Ratteries
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\RatteryMessage newEmptyEntity()
 * @method \App\Model\Entity\RatteryMessage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RatteryMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RatteryMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\RatteryMessage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RatteryMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RatteryMessage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RatteryMessage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatteryMessage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatteryMessage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatteryMessage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatteryMessage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatteryMessage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RatteryMessagesTable extends Table
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

        $this->setTable('rattery_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ratteries', [
            'foreignKey' => 'rattery_id',
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
            ->nonNegativeInteger('rattery_id')
            ->notEmptyString('rattery_id');

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
        $rules->add($rules->existsIn('rattery_id', 'Ratteries'), ['errorField' => 'rattery_id']);
        $rules->add($rules->existsIn('from_user_id', 'Users'), ['errorField' => 'from_user_id']);

        return $rules;
    }

    public function findEntitled(Query $query, array $options) {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['user_id'])) {
            $query->leftJoinWith('Ratteries')
                ->where(['Ratteries.owner_user_id' => null]);
        } else {
            $query->innerJoinWith('Ratteries')
                ->where(['Ratteries.owner_user_id' => $options['user_id']]);
        }

        return $query; //->group(['RatteryMessages.id']);
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
                'owner_user_id' => $options['user_id'],
                'RatteryMessages.created >=' => $options['delay']
            ];
        }

        $query
            ->order('RatteryMessages.created DESC')
            ->contain([
                'Ratteries',
                'Ratteries.RatteryMessages' => ['sort' => 'RatteryMessages.created DESC'],
                'Ratteries.Users',
                'Ratteries.States',
                'Users'
            ])
            ->where($filter);

        return $query;
    }
}
