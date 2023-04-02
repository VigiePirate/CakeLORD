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
        $this->SnapshotsTable = FactoryLocator::get('Table')->get($config['repository']);
    }

    /**
     * beforeSave method
     *
     * Automatically takes a snapshot of the previous version before saving the object.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->snapShoot($entity);
    }

    /**
     * snapShoot method
     *
     * Stores a JSON serialized string of the entity, with a few metadata (entity->id, entity->state_id).
     * The save operation will fail if the snapshot fails to be saved.
     *
     * @param EntityInterface $entity
     * @return void
     */
    public function snapShoot(EntityInterface $entity)
    {
        // Do nothing if the entity is new
        if (! $entity->isNew()) {
            $saved_entity = $this->table()->get($entity->id);
            $snapshot_values = [
                'data' => json_encode($saved_entity),
                $this->config['entityField'] => $saved_entity->id,
                'state_id' => $saved_entity->state_id,
            ];
            $new_snapshot = $this->SnapshotsTable->newEntity($snapshot_values);
            if (! $this->SnapshotsTable->save($new_snapshot)) {
                $event->stopPropagation();
                $event->setResult(false);
            }
        }
        return;
    }

    /**
     * snapRestore method
     *
     * Loads a JSON snapshot and marshall it as an entity, saves it, and deletes the snapshot.
     *
     * @param EntityInterface $entity
     * @param Integer $snapshot_id
     * @return boolean
     */
    public function snapRestore(EntityInterface $entity, $snapshot_id)
    {
        $this->getTable()->removeBehavior('Picture');
        if ($entity->set($this->snapLoad($entity, $snapshot_id), ['guard' => false])) {
            if ($this->getTable()->save($entity, ['checkRules' => false])) {
                return $this->snapDelete($entity, $snapshot_id);
            }
        }
        return false;
    }

    /**
     * snapLoad method
     *
     * Loads a JSON snapshot and returns it as an associative array. Let the
     * created and modified fields untouched.
     *
     * @param EntityInterface $entity
     * @param Integer $snapshot_id
     * @return array|boolean
     */
    public function snapLoad(EntityInterface $entity, $snapshot_id)
    {
        $snapshot = $this->SnapshotsTable->get($snapshot_id);
        if ($snapshot->{$this->config['entityField']} == $entity->id) {
            $data = json_decode($snapshot->data, true);
            unset($data['created'], $data['modified']);
            return $data;
        }
        return false;
    }

    /**
     * snapLoad method
     *
     * Deletes a snapshot belonging to the entity.
     *
     * @param EntityInterface $entity
     * @param Integer $snapshot_id
     * @return boolean
     */
    public function snapDelete(EntityInterface $entity, $snapshot_id)
    {
        $snapshot = $this->SnapshotsTable->get($snapshot_id);
        if ($snapshot->{$this->config['entityField']} == $entity->id) {
            $this->SnapshotsTable->delete($snapshot);
            return true;
        }
        return false;
    }

    /**
     * snapCompare method
     *
     * Compares a snapshot to the current entity.
     *
     * @param EntityInterface $entity
     * @param Integer $snapshot_id
     * @return array|boolean
     */
    public function snapCompare(EntityInterface $entity, $snapshot_id)
    {
        $snapshot = $this->SnapshotsTable->get($snapshot_id);
        if ($snapshot->{$this->config['entityField']} == $entity->id) {
            if ($snapshot_data = $this->snapLoad($entity, $snapshot_id)) {
                $raw_entity = $this->table()->get($entity->id);
                $entity_data = json_decode(json_encode($raw_entity), true);
                return array_diff_assoc($snapshot_data,$entity_data);
            }
        }
        return false;
    }

    /**
     * snapCompareAsString method
     *
     * Compares a snapshot to the current entity.
     *
     * @param EntityInterface $entity
     * @param Integer $snapshot_id
     * @return string
     */
    public function snapCompareAsString(EntityInterface $entity, $snapshot_id)
    {
        if ($diff_array = $this->snapCompare($entity, $snapshot_id)) {
            foreach ($diff_array as $key => $value) {
                $diff_array[$key] = $key . ': ' . $value;
            }
            return implode(', ', $diff_array);
        }
        return false;
    }

    /**
     * snapDiffListAsString method
     *
     * Compares a snapshot to the current entity, returns the names of the modified fields only (not the values)
     *
     * @param EntityInterface $entity
     * @param Integer $snapshot_id
     * @return string
     */
    public function snapDiffListAsString(EntityInterface $entity, $snapshot_id)
    {
        if ($diff_array = $this->snapCompare($entity, $snapshot_id)) {
            foreach ($diff_array as $key => $value) {
                $diff_array[$key] = $key;
            }
            return implode(', ', $diff_array);
        }
        return false;
    }
}
