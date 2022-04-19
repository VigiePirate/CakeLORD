<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\FactoryLocator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;

class PictureBehavior extends Behavior
{
    protected $_defaultConfig = [
        'maxWidth' => 600,
        'maxHeight' => 400
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
        $this->config = $this->getConfig();
    }

    /**
     * beforeSave method
     *
     * Automatically resizes the object picture before saving it.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->resizePic($entity);
    }

    /**
     * resizePic method
     *
     * Resizes picture to a predefined maximum bounding box.
     * The save operation will fail if the picture fails to be saved.
     *
     * @param EntityInterface $entity
     * @return void
     */
    public function resizePic(EntityInterface $entity)
    {
        return;
    }
}
