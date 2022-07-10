<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Geo\Geocoder\Geocoder;

/**
 * Ratteries Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\ConversationsTable&\Cake\ORM\Association\HasMany $Conversations
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 * @property \App\Model\Table\RatterySnapshotsTable&\Cake\ORM\Association\HasMany $RatterySnapshots
 * @property \App\Model\Table\LittersTable&\Cake\ORM\Association\BelongsToMany $Litters
 *
 * @method \App\Model\Entity\Rattery newEmptyEntity()
 * @method \App\Model\Entity\Rattery newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Rattery[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rattery get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rattery findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Rattery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rattery[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rattery|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rattery saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RatteriesTable extends Table
{
    const MAXIMAL_INACTIVITY = 730;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('ratteries');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Picture', ['slug' => 'prefix']);
        $this->addBehavior('Snapshot', [
            'repository' => 'RatterySnapshots',
            'entityField' => 'rattery_id',
        ]);
        $this->addBehavior('State', [
            'safe_properties' => [
                'modified',
                'state_id',
                'district',
                'zip_code',
                'country_id',
                'latitude',
                'longitude'
            ],
        ]);

        /* configuration to be added in app_local:
         * 'Geocoder' => [
         *      'address' => 'zip_code', 'district', 'country_name']
                'apiKey' => 'your Googlemaps platform API key (Geocoding API)',
                'locale' => 'fr',
                'lat' => 'latitude',
                'lng' => 'longitude'
            ]
        */
        if (! empty($geo_config = Configure::read('Geocoder'))) {
            $this->addBehavior('Geo.Geocoder', $geo_config);
        }

        $this->belongsTo('Users', [
            'foreignKey' => 'owner_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Conversations', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->hasMany('RatterySnapshots', [
            'foreignKey' => 'rattery_id',
        ]);
        $this->belongsToMany('Litters', [
            'through' => 'Contributions',
        ]);
        $this->hasMany('Contributions', [
            'foreignKey' => 'rattery_id',
            'finder' => 'Ordered',
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
            ->scalar('prefix')
            ->maxLength('prefix', 4)
            ->requirePresence('prefix', 'create')
            ->notEmptyString('prefix')
            ->add('prefix', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 70)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('birth_year')
            ->allowEmptyString('birth_year');

        $validator
            ->boolean('is_alive')
            ->notEmptyString('is_alive');

        $validator
            ->boolean('is_generic')
            ->notEmptyString('is_generic');

        $validator
            ->scalar('district')
            ->maxLength('district', 70)
            ->allowEmptyString('district');

        $validator
            ->scalar('zip_code')
            ->maxLength('zip_code', 12)
            ->allowEmptyString('zip_code');

        $validator
            ->scalar('website')
            ->maxLength('website', 255)
            ->allowEmptyString('website');

        $validator
            ->scalar('comments')
            ->allowEmptyString('comments');

        $validator
            ->boolean('wants_statistic')
            ->notEmptyString('wants_statistic');

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->notEmptyString('picture');

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
        $rules->add($rules->isUnique(['name']));
        $rules->add($rules->isUnique(['prefix']));
        $rules->add($rules->existsIn(['owner_user_id'], 'Users'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }

    // Finder Functions

    // Find active ratteries with known location
    public function findLocated(Query $query, array $options) {

        $filter = [
            'is_alive' => true,
            'zip_code !=' => '',
            'latitude IS NOT' => null,
            'longitude IS NOT' => null
        ];

        if (! empty($options)) {
            $filter = array_merge($filter, $options);
        }

        $query = $query
        ->select()
        ->where($filter);

        return $query;
    }

    // Search rattery by name or prefix
    public function findNamed(Query $query, array $options)
    {
      $query = $query
      ->select()
      ->distinct()
      ->order(['prefix' => 'ASC']);

      if (empty($options['names'])) {
        $query->where([
          'OR' => ['Ratteries.prefix IS' => null, 'Ratteries.name IS' => null],
        ]);
      } else {
        $query->where([
          'OR' => [
            'Ratteries.prefix LIKE' => '%'.implode($options['names']).'%',
            'Ratteries.name LIKE' => '%'.implode($options['names']).'%',
          ],
        ]);
      }

      return $query;
    }

    public function findOwnedBy(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['users'])) {
            $query->leftJoinWith('Users')
                  ->where([
                      'Users.username IS' => null,
                  ]);
        } else {
            $query->innerJoinWith('Users')
                  ->where([
                          'Users.username LIKE' => '%'.implode($options['users']).'%',
                ]);
        }

        return $query->group(['Ratteries.id']);
    }

    public function findInState(Query $query, array $options)
    {
        $query = $query
            ->select()
            ->distinct();

        if (empty($options['inState'])) {
            $query->where([
                'Ratteries.state_id IS' => null,
            ]);
        } else {
            // Find rats with birthdates posterior to passed parameter
            $inState = implode($options['inState']);
            // concatenate with  . " 00:00:00.000" ??
            $query->where([
                    'Ratteries.state_id IS' => $inState,
            ]);
        }

        return $query->group(['Ratteries.id']);
    }

    public function pauseZombies()
    {
        $contributions = \Cake\Datasource\FactoryLocator::get('Table')->get('Contributions');
        $latest = $contributions->find()
            ->select([
                'rattery_id' => 'rattery_id',
                'latest' => 'DATEDIFF(NOW(), MAX(Litters.birth_date))'
            ])
            ->innerJoinWith('Litters')
            ->group('rattery_id')
            ->enableAutoFields(true) // should be replaced by selecting only useful fields
            ->enableHydration(false)
            ->toArray();

        $ids = array_column(
            array_filter($latest, function($d) {
                return $d['latest'] > RatteriesTable::MAXIMAL_INACTIVITY;
            }),
            'rattery_id'
        );

        $comment = __('**This sheet was automatically updated to set the rattery as inactive, as it hasn’t bred any litter for several years.**');

        $query = $this->find()
            ->where([
                'id IN' => $ids,
                'is_alive IS' => true
            ]);

        $count = $query->select()->count();

        $update = $query->update()
            ->set([
                'is_alive' => false,
                'comments' => $query->func()->concat(['comments' => 'identifier', 'CHAR (10)' => 'identifier', 'CHAR (13)' => 'identifier', $comment])
            ])
            ->execute();

        return $count;
    }
}
