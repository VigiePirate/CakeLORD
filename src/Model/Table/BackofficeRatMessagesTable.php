<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BackofficeRatMessages Model
 *
 * @property \App\Model\Table\BackofficeRatEntriesTable&\Cake\ORM\Association\BelongsTo $BackofficeRatEntries
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\BackofficeRatMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\BackofficeRatMessage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BackofficeRatMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatMessage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BackofficeRatMessage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BackofficeRatMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatMessage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BackofficeRatMessage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BackofficeRatMessagesTable extends Table
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

        $this->setTable('backoffice_rat_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BackofficeRatEntries', [
            'foreignKey' => 'backoffice_rat_entry_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'staff_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('staff_comments')
            ->allowEmptyString('staff_comments');

        $validator
            ->scalar('owner_comments')
            ->allowEmptyString('owner_comments');

        $validator
            ->date('date_staff_comments')
            ->allowEmptyDate('date_staff_comments');

        $validator
            ->date('date_owner_comments')
            ->allowEmptyDate('date_owner_comments');

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
        $rules->add($rules->existsIn(['backoffice_rat_entry_id'], 'BackofficeRatEntries'));
        $rules->add($rules->existsIn(['staff_id'], 'Users'));

        return $rules;
    }
}
