<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\FactoryLocator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Routing\Router;

class StateBehavior extends Behavior
{
    protected $_defaultConfig = [
        'repository' => 'States',
        'safe_properties' => ['modified', 'state_id'],
        'decision_form_field' => 'decision',
        #'explanation_form_field' => 'content',
        'explanation_form_field' => 'side_message',
        'neglection_delay' => '30 days',
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
        $this->Identity = Router::getRequest()->getAttribute('identity');
        $this->previous_state = null;
        $this->new_state = null;
        $this->now = \Cake\Chronos\Chronos::now();
        $this->messages = [];
    }

    /**
     * beforeMarshal method
     *
     * get the user message associated to the state change (if any), and keep it
     * for the event to dispatch in the afterSave method.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $data
     * @param ArrayObject $options
     * @return boolean
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        return true;
    }

    /**
     * afterMarshal method
     *
     * get the user message associated to the state change (if any), and keep it
     * for the event to dispatch in the afterSave method.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $data
     * @param ArrayObject $options
     * @return boolean
     */
    public function afterMarshal(EventInterface $event, EntityInterface $entity, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data[$this->config['explanation_form_field']]) && ! empty($data[$this->config['explanation_form_field']])) {
            $this->messages[] = [
                'content' => $data[$this->config['explanation_form_field']],
                'is_automatically_generated' => false,
            ];
        }
        if (isset($data[$this->config['decision_form_field']])) {
            $decision = $data[$this->config['decision_form_field']];
            return $this->$decision($entity);
        }
        return true;
    }

    /**
     * beforeSave method
     *
     * Modify the state at each save.
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
            $this->new_state = $initial_state;
            $entity->set('state_id', $initial_state->id);
            return $entity->state_id;
        } else {
            if (! empty(array_diff($entity->getDirty(), $this->config['safe_properties']))) {
                return $this->blame($entity);
            } else {
                // All the changes are in the safe list
                return true;
            }
        }
    }

    /**
     * afterSave method
     *
     * Generates an event about the state change.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $state_event = new Event('Model.State.modified', $entity, [
            'identity' => $this->Identity,
            'previous_state' => $this->previous_state,
            'new_state' => $this->new_state,
            'emitted' => $this->now,
            'messages' => array_unique($this->messages), // FIXME: dirty fix for duplicate messages on blameNeglected calls
        ]);
        if (count($state_event->getData('messages')) > 1) {
            dd($state_event);
        }
        $this->table()->getEventManager()->dispatch($state_event);
    }

    /**
     * ChangeState method
     *
     * Actually modify the entity state and prepare the change event
     * circumstances and messages.
     *
     * @param EntityInterface $entity
     * @param int $new_state_id
     * @param array $context
     * @return boolean
     */
    public function changeState(EntityInterface $entity, int $new_state_id, array $context)
    {
        if ($entity->has('state') && isset($new_state_id)) {
            $this->previous_state = $entity->state;
            $entity->state_id = $new_state_id;
            $this->new_state = $this->States->get($entity->state_id);

            if ($context['negligence']) {
                $content = __("The sheet was not corrected as required in due time and escalated to back-office.");
            } else {
                $content = __("The sheet was {0} as a result of an action by {1}.",
                                [
                                    $context['action'],
                                    $this->Identity->username
                                ]
                            );
            }

            $this->messages[] = [
                'content' => $content,
                'is_automatically_generated' => true,
            ];
            return true;
        }
        return false;
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
            if ($this->changeState($entity, $entity->state->next_ok_state_id, ['action' => __('approved')])) {
                return true;
            }
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
    public function blame(EntityInterface $entity, bool $negligence=false)
    {
        if ($entity->has('state') && $entity->state->next_ko_state_id) {
            if ($this->changeState($entity, $entity->state->next_ko_state_id, ['action' => __('blamed'), 'negligence' => $negligence])) {
                return true;
            }
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
            if ($this->changeState($entity, $entity->state->next_frozen_state_id, ['action' => __('frozen')])) {
                return true;
            }
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
            if ($this->changeState($entity, $entity->state->next_thawed_state_id, ['action' => __('thawed')])) {
                return true;
            }
        }
        return false;
    }

    /**
     * blameNeglected method
     *
     * Blame all objects for which user action is needed, yet nothing happened
     * after $this->config['neglection_delay'].
     *
     * @param Table $table
     * @return boolean
     */
    public function blameNeglected(Table $table) {
        $query = $table->find('needsUser')->contain('States');
        $query = $query->where(['modified <= ' => \Cake\Chronos\Chronos::today()->modify('-'.$this->config['neglection_delay'])]);
        $entities = $query->all()->map(function ($value, $key) {
            $this->blame($value, true);
            return $value;
        });

        if ($table->saveMany($entities, ['checkRules' => false, 'associated' => []])) {
            return $entities->count();
        } else {
            return -1; //FIXME should raise exception
        }
    }

}
