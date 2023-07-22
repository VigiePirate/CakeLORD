<?php
declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;

/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Picture', [
            'maxWidth' => 450,
            'maxHeight' => 300,
            'thumbnail' => false,
            'field_name' => 'avatar'
        ]);

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('OwnerRats', [
            'className' => 'Rats',
            'foreignKey' => 'owner_user_id',
        ]);
        $this->hasMany('CreatorRats', [
            'className' => 'Rats',
            'foreignKey' => 'creator_user_id',
        ]);
        $this->hasMany('Ratteries', [
            'className' => 'Ratteries',
            'foreignKey' => 'owner_user_id',
        ]);
        $this->hasMany('Litters', [
            'className' => 'Litters',
            'foreignKey' => 'creator_user_id',
        ]);
        $this->hasMany('FromIssues', [
            'className' => 'Issues',
            'foreignKey' => 'from_user_id',
        ]);
        $this->hasMany('ClosingIssues', [
            'className' => 'Issues',
            'foreignKey' => 'closing_user_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 70)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('username')
            ->maxLength('username', 45)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 45)
            ->allowEmptyString('firstname');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 45)
            ->allowEmptyString('lastname');

        $validator
            ->date('birth_date')
            ->allowEmptyDate('birth_date');

        $validator
            ->scalar('sex')
            ->allowEmptyString('sex');

        $validator
            ->scalar('localization')
            ->maxLength('localization', 255)
            ->allowEmptyString('localization');

        $validator
            ->scalar('avatar')
            ->maxLength('avatar', 255)
            ->notEmptyString('avatar');

        $validator
            ->scalar('about_me')
            ->allowEmptyString('about_me');

        $validator
            ->boolean('wants_newsletter')
            ->notEmptyString('wants_newsletter');

        $validator
            ->notEmptyString('failed_login_attempts');

        $validator
            ->dateTime('failed_login_last_date')
            ->allowEmptyDateTime('failed_login_last_date');

        $validator
            ->boolean('is_locked')
            ->notEmptyString('is_locked');

        $validator
            ->scalar('staff_comments')
            ->allowEmptyString('staff_comments');

        $validator
            ->scalar('passkey')
            ->maxLength('passkey', 23)
            ->allowEmptyString('passkey');

        return $validator;
    }

    /**
     * beforeMarshal method
     *
     * @param EventInterface $event
     * @param ArrayObject $data
     * @param ArrayObject $options
     * @return void
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        // hack to give a non-empty label to the empty option in select input
        if (isset($data['sex']) && $data['sex'] == 'X') {
            $data['sex'] = '';
        }

        // trick for browsers autofill
        if (isset($data['nickname'])) {
            $data['username'] = $data['nickname'];
        }
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
        $rules->add(
            $rules->isUnique(['email']),
            'validEmail',
            [
                'errorField' => 'email',
                'message' => __('This email is already in use. If you have lost your password, please use the password recovery tool.'),
            ]
        );

        $rules->addCreate(
            $rules->isUnique(['username']),
            'validName',
            [
                'errorField' => 'nickname',
                'message' => __('This username is already in use. Please choose another one.'),
            ]
        );

        $rules->addUpdate(
            $rules->isUnique(['username']),
            'validName',
            [
                'errorField' => 'username',
                'message' => __('This username is already in use. Please choose another one.'),
            ]
        );

        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }

    public function findNamed(Query $query, array $options)
    {
        $columns = [
            'Users.id', 'Users.username', 'Users.role_id'
        ];

        $query = $query
            ->select()
            ->distinct();

        if (empty($options['names'])) {
            $query->where([
                'OR' => ['Users.username IS' => null],
            ]);
        } else {
            // Find rats with parts of the string in that name
            $query->where([
                'Users.username LIKE' => '%'.implode($options['names']).'%',
            ]);
        }

        return $query->group(['Users.id']);
    }

    public function findPrivate(Query $query, array $options)
    {
        $columns = [
            'Users.id', 'Users.username', 'Users.role_id'
        ];

        $query = $query
            ->select()
            ->distinct();

        if (empty($options['names'])) {
            $query->where([
                'OR' => ['Users.username IS' => null],
            ]);
        } else {
            // Find rats with parts of the string in that name
            $query->where([
                'OR' => [
                    'Users.username LIKE' => '%'.implode($options['names']).'%',
                    'Users.firstname LIKE' => '%'.implode($options['names']).'%',
                    'Users.lastname LIKE' => '%'.implode($options['names']).'%',
                    'Users.email LIKE' => '%'.implode($options['names']).'%',
                ]
            ]);
        }

        return $query->group(['Users.id']);
    }

    public function removeExpiredPasskeys()
    {
        $query = $this->find()->where([
            'passkey IS NOT' => null,
            'failed_login_last_date IS NOT' => null,
            'failed_login_last_date <=' => \Cake\Chronos\Chronos::now()->modify('-24 hours'),
        ]);

        foreach ($query->all() as $user) {
            // never activated
            if ($user->is_locked && is_null($user->successful_login_last_date)) {
                $this->delete($user);
            } else { // just expired passkey
                $user->passkey = null;
                $this->save($user);
            }
        }

    }
}
