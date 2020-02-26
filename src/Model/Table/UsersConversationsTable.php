<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersConversations Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ConversationsTable&\Cake\ORM\Association\BelongsTo $Conversations
 *
 * @method \App\Model\Entity\UsersConversation newEmptyEntity()
 * @method \App\Model\Entity\UsersConversation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UsersConversation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersConversation get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersConversation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UsersConversation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersConversation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersConversation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersConversation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersConversation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersConversation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersConversation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersConversation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersConversationsTable extends Table
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

        $this->setTable('users_conversations');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey(['user_id', 'conversation_id']);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Conversations', [
            'foreignKey' => 'conversation_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['conversation_id'], 'Conversations'));

        return $rules;
    }
}
