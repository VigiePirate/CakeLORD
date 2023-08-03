<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\FactoryLocator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\Table;

class StateBehavior extends Behavior
{
    protected $_defaultConfig = [
        'repository' => 'States',
        'safe_properties' => ['modified', 'state_id'],
    ];

    /**
     * Initialize method
     *
     * Initializes the behavior with configuration values. The array of
     * configuration values passed in the Table->addBehavior() method will
     * overwrite the default values.
     *
     * @param array $config array of configuration values.
     * @return void
     */
    public function initialize(array $config): void
    {
        if (empty($config)) {
            $config = $this->_defaultConfig;
        }
        $this->config = $this->getConfig();
        $this->States = FactoryLocator::get('Table')->get($this->config['repository']);
    }

    /**
     * beforeSave method
     *
     * Generates a message about the state change.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return boolean
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->isNew()) {
            $initial_state = $this->States->find()->select('id')->where(['is_default' => true])->firstOrFail();
            $entity->set('state_id', $initial_state->id);
            return $entity->state_id;
        } elseif (! empty(array_diff($entity->getDirty(), $this->config['safe_properties']))) {
            return $this->blame($entity);
        } else {
            // All the changes are in the safe list
            // return $this->approve($entity);
            return true;
        }
    }

    /**
     * afterSave method
     *
     * Generates a message about the state change.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
    }

    /**
     * Approve method
     *
     * Put the entity in the next_ok_state
     *
     * @param EntityInterface $entity
     * @return boolean
     */
    public function approve(EntityInterface $entity)
    {
        if ($entity->has('state') && $entity->state->next_ok_state_id) {
            $entity->state_id = $entity->state->next_ok_state_id;
            return true;
        }
        return false;
    }

    /**
     * Blame method
     *
     * Put the entity in the next_ko_state
     *
     * @param EntityInterface $entity
     * @return boolean
     */
    public function blame(EntityInterface $entity)
    {
        if ($entity->has('state') && $entity->state->next_ko_state_id) {
            $entity->state_id = $entity->state->next_ko_state_id;
            return true;
        }
        return false;
    }

    /**
     * Freeze method
     *
     * Put the entity in the next_frozen_state
     *
     * @param EntityInterface $entity
     * @return boolean
     */
    public function freeze(EntityInterface $entity)
    {
        if ($entity->has('state') && $entity->state->next_frozen_state_id) {
            $entity->state_id = $entity->state->next_frozen_state_id;
            return true;
        }
        return false;
    }

    /**
     * Thaw method
     *
     * Put the entity in the next_thawed_state
     *
     * @param EntityInterface $entity
     * @return boolean
     */
    public function thaw(EntityInterface $entity)
    {
        if ($entity->has('state') && $entity->state->next_thawed_state_id) {
            $entity->state_id = $entity->state->next_thawed_state_id;
            return true;
        }
        return false;
    }

    public function blameNeglected(Table $table) {
        $query = $table->find('needsUser')->contain('States');
        $query = $query->where(['modified <= ' => \Cake\Chronos\Chronos::today()->modify('-15 days')]);
        $entities = $query->all()->map(function ($value, $key) {
            $this->blame($value);
            return $value;
        });
        if ($table->saveMany($entities, ['checkRules' => false, 'associated' => []])) {
            return $entities->count();
        } else {
            return -1; //FIXME should raise exception
        }

    }

}
