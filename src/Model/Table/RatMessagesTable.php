<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Datasource\FactoryLocator;
use Cake\Validation\Validator;

/**
 * RatMessages Model
 *
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\BelongsTo $Rats
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\RatMessage newEmptyEntity()
 * @method \App\Model\Entity\RatMessage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RatMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RatMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\RatMessage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RatMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RatMessage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RatMessage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatMessage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RatMessage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatMessage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatMessage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RatMessage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RatMessagesTable extends Table
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

        $this->setTable('rat_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Rats', [
            'foreignKey' => 'rat_id',
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
            ->nonNegativeInteger('rat_id')
            ->notEmptyString('rat_id');

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
        $rules->add($rules->existsIn('rat_id', 'Rats'), ['errorField' => 'rat_id']);
        $rules->add($rules->existsIn('from_user_id', 'Users'), ['errorField' => 'from_user_id']);

        return $rules;
    }

    public function findFromUser(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        $user_id = $options['user_id'];

        if (empty($user_id)) {
            return $query;
        } else {
            $query
                ->contain([
                    'Rats',
                    'Rats.Ratteries',
                    'Rats.CreatorUsers',
                    'Rats.OwnerUsers',
                    'Rats.BirthLitters',
                    'Rats.BirthLitters.Contributions',
                    'Rats.States',
                    'Users'
                ])
                ->where(['from_user_id' => $user_id]);
        }

        return $query->group(['RatMessages.id']);
    }

    public function findEntitled(Query $query, array $options) {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['user_id'])) {
            $query->leftJoinWith('Rats')
                ->where([
                  'CreatorUsers.id' => null,
                  'OwnerUsers.id' => null,
                ]);
        } else {
            $query->contain(['Rats', 'Rats.CreatorUsers', 'Rats.OwnerUsers'])
                ->where([
                  'OR' => [
                      'CreatorUsers.id' => $options['user_id'],
                      'OwnerUsers.id' => $options['user_id'],
                  ]
                ]);
        }

        return $query->group(['RatMessages.id']);
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
                'OR' => [
                    'CreatorUsers.id' => $options['user_id'],
                    'OwnerUsers.id' => $options['user_id'],
                ],
                'RatMessages.created >=' => $options['delay'],
            ];
        }

        $query
            ->order('RatMessages.created DESC')
            ->contain([
                'Rats',
                'Rats.RatMessages' => ['sort' => 'RatMessages.created DESC'],
                'Rats.Ratteries',
                'Rats.CreatorUsers',
                'Rats.OwnerUsers',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Contributions',
                'Rats.States',
                'Users'
            ])
            ->where($filter);

        return $query->group(['RatMessages.id']);
        //->order(['RatMessages.created DESC'])->group(['Rats.id']);
    }
}
