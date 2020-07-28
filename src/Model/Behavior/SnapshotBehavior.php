<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\FactoryLocator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;

class SnapshotBehavior extends Behavior
{
    protected $_defaultConfig = [
        'repository' => 'Snapshots',
        'entityField' => 'entity_id',
    ];

    public function initialize(array $config): void
    {
        $this->config = $this->getConfig();
        $this->SnapshotTable = FactoryLocator::get('Table')->get($config['repository']);
        // Some initialization code here
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->snapShoot($entity);
    }

    public function snapShoot(EntityInterface $entity)
    {
        $saved_entity = $this->getTable()->get($entity->id);
        $snapshot_values = [
            'data' => json_encode($saved_entity),
            $this->config['entityField'] => $saved_entity->id,
            'state_id' => $saved_entity->state_id,
        ];
        $new_snapshot = $this->SnapshotTable->newEntity($snapshot_values);
        if (! $this->SnapshotTable->save($new_snapshot)) {
            $event->stopPropagation();
            $event->setResult(false);
        }
        return;
    }

    public function snapLoad(EntityInterface $entity, $snap_id = null)
    {
    }
}
