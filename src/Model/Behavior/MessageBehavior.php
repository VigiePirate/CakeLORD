<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\FactoryLocator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\Event\EventListenerInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Routing\Router;
use Cake\Collection\Collection;

class MessageBehavior extends Behavior
{
    protected $_defaultConfig = [
        'repository' => 'Messages',
        'entityField' => 'entity_id',
    ];

    private $queue = [];

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
        $this->config = $this->getConfig();
        $this->MessagesTable = FactoryLocator::get('Table')->get($config['repository']);
        $this->table()->getEventManager()->on('Model.State.modified', [$this, 'queueMessage']);
        $this->table()->getEventManager()->on('Model.Snapshot.restored', [$this, 'queueMessage']);
        $this->table()->getEventManager()->on('Model.Rats.deceased', [$this, 'queueMessage']);
    }

    /**
     * queueMessage method
     *
     * Push a message in the queue. All the messages in the queue will be sent
     * after the entity is saved.
     *
     * @param EntityInterface $entity
     * @return void
     */
    public function queueMessage(EventInterface $event)
    {
        $entity = $event->getSubject();
        $data = $event->getData();
        $identity = $data['identity'];
        $messages = [];

        foreach ($data['messages'] as $entry) {
            $messages[] = $this->MessagesTable->newEntity([
                $this->config['entityField'] => $entity->id,
                'from_user_id' => $identity->id,
                'created' => $data['emitted'],
                'content' => $entry['content'],
                'is_staff_request' => $identity->role->is_staff && $data['new_state']->needs_user_action,
                'is_automatically_generated' => $entry['is_automatically_generated'],
            ]);
        }

        $user_name = $identity->username;
        $user_is_staff = $identity->role->is_staff;
        $this->MessagesTable->saveMany($messages);
        return;
    }

    /**
     * sendMessageQueue method
     *
     * Send the messages in the queue, that is save each of them in the
     * MessagesTable, and possibly send them via e-mail, if user preferences
     * wish so.
     *
     * @param EntityInterface $entity
     * @return void
     */
    public function sendMessageQueue(EntityInterface $entity)
    {
        return;
    }

    /**
     * getLastMessage method
     *
     * Get the most recent (highest id) message associated with the entity.
     *
     * @param EntityInterface $entity
     * @return void
     */
    public function getLastMessage(EntityInterface $entity)
    {
        return;
    }

    /**
     * getLastMessages method
     *
     * Get the n most recents (highest id) messages associated with the entity.
     *
     * @param EntityInterface $entity
     * @param integer $message_number
     * @return void
     */
    public function getLastMessages(EntityInterface $entity, int $n)
    {
        return;
    }

    /**
     * getNextMessage method
     *
     * Get the next message associated with the entity, in descending order
     * (from the most recent to the most ancient).
     *
     * @param EntityInterface $entity
     * @param integer $message_number
     * @return void
     */
    public function getNextMessage(EntityInterface $entity, int $message_number)
    {
        return;
    }

    /**
     * setMessageFilter method
     *
     * Set a filter on further messages get operations : only staff messages,
     * no automatically generated message, etc. Do not affect queuing
     * operations.
     *
     * @param EntityInterface $entity
     * @param ArrayObject $filter
     * @return void
     */
    public function setMessageFilter(EntityInterface $entity, ArrayObject $filter)
    {
        return;
    }
}
