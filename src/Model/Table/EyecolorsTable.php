<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Eyecolors Model
 *
 * @property \App\Model\Table\BackofficeRatEntriesTable&\Cake\ORM\Association\HasMany $BackofficeRatEntries
 * @property \App\Model\Table\ColorsTable&\Cake\ORM\Association\HasMany $Colors
 * @property \App\Model\Table\RatsTable&\Cake\ORM\Association\HasMany $Rats
 *
 * @method \App\Model\Entity\Eyecolor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Eyecolor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Eyecolor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Eyecolor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eyecolor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eyecolor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Eyecolor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Eyecolor findOrCreate($search, callable $callback = null, $options = [])
 */
class EyecolorsTable extends Table
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

        $this->setTable('eyecolors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('BackofficeRatEntries', [
            'foreignKey' => 'eyecolor_id',
        ]);
        $this->hasMany('Colors', [
            'foreignKey' => 'eyecolor_id',
        ]);
        $this->hasMany('Rats', [
            'foreignKey' => 'eyecolor_id',
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
            ->scalar('name_fr')
            ->maxLength('name_fr', 70)
            ->allowEmptyString('name_fr');

        $validator
            ->scalar('name_en')
            ->maxLength('name_en', 70)
            ->allowEmptyString('name_en');

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->allowEmptyString('picture');

        return $validator;
    }
}
