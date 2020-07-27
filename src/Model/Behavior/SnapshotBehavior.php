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
        // Some initialization code here
    }

    public function snapshoot(EntityInterface $entity)
    {
        $config = $this->getConfig();
        $snapshotTable = FactoryLocator::get('Table')->get($config['repository']);
        $snapshot_values = [
            'data' => json_encode($entity),
            $config['entityField'] => $entity->id,
            'state_id' => $entity->state_id,
        ];
        $new_snapshot = $snapshotTable->newEntity($snapshot_values);
        if (! $snapshotTable->save($new_snapshot)) {
            $event->stopPropagation();
            $event->setResult(false);
        }
        return debug($new_snapshot);
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->snapshoot($entity);
    }
}
