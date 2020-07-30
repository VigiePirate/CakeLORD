<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\FactoryLocator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;

class StateBehavior extends Behavior
{
    protected $_defaultConfig = [
        'repository' => 'States',
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
        } else {
            $config = array_merge($this->_defaultConfig, $config);
        }
        $this->config = $this->getConfig();
        $this->StatesTable = FactoryLocator::get('Table')->get($config['repository']);
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
        if ($entity->has('state') && $entity->state.next_ok_state_id) {
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
}
