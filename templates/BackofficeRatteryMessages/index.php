<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatteryMessage[]|\Cake\Collection\CollectionInterface $backofficeRatteryMessages
 */
?>
<div class="backofficeRatteryMessages index content">
    <?= $this->Html->link(__('New Backoffice Rattery Message'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Backoffice Rattery Messages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('staff_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($backofficeRatteryMessages as $backofficeRatteryMessage): ?>
                <tr>
                    <td><?= $this->Number->format($backofficeRatteryMessage->id) ?></td>
                    <td><?= $backofficeRatteryMessage->has('rattery') ? $this->Html->link($backofficeRatteryMessage->rattery->name, ['controller' => 'Ratteries', 'action' => 'view', $backofficeRatteryMessage->rattery->id]) : '' ?></td>
                    <td><?= $backofficeRatteryMessage->has('user') ? $this->Html->link($backofficeRatteryMessage->user->id, ['controller' => 'Users', 'action' => 'view', $backofficeRatteryMessage->user->id]) : '' ?></td>
                    <td><?= h($backofficeRatteryMessage->created) ?></td>
                    <td><?= h($backofficeRatteryMessage->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $backofficeRatteryMessage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $backofficeRatteryMessage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $backofficeRatteryMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatteryMessage->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
