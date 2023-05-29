<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\FactoryLocator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Routing\Router;

class MessagesBehavior extends Behavior
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
    }

    /**
     * afterSave method
     *
     * Send automatic notifications once the object is saved.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $identity = Router::getRequest()->getAttribute('identity');
        $user_name = $identity->username;
        $user_email = $identity->email;
        $user_wants_email = $identity->wants_newsletter;
        return;
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
    public function queueMessage(EntityInterface $entity)
    {
        $identity = Router::getRequest()->getAttribute('identity');
        $user_name = $identity->username;
        $user_is_staff = $identity->role->is_staff;
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
    public function getLastMessages(EntityInterface $entity, integer $n)
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
    public function getNextMessage(EntityInterface $entity, integer $message_number)
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
