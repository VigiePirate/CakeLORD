<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RatteryMessage> $ratteryMessages
 */
?>
<div class="ratteryMessages index content">
    <?= $this->Html->link(__('New Rattery Message'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rattery Messages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('from_user_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('is_staff_request') ?></th>
                    <th><?= $this->Paginator->sort('is_automatically_generated') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratteryMessages as $ratteryMessage): ?>
                <tr>
                    <td><?= $this->Number->format($ratteryMessage->id) ?></td>
                    <td><?= $ratteryMessage->has('rattery') ? $this->Html->link($ratteryMessage->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $ratteryMessage->rattery->id]) : '' ?></td>
                    <td><?= $ratteryMessage->has('user') ? $this->Html->link($ratteryMessage->user->username, ['controller' => 'Users', 'action' => 'view', $ratteryMessage->user->id]) : '' ?></td>
                    <td><?= h($ratteryMessage->created) ?></td>
                    <td><?= h($ratteryMessage->is_staff_request) ?></td>
                    <td><?= h($ratteryMessage->is_automatically_generated) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ratteryMessage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ratteryMessage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ratteryMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratteryMessage->id)]) ?>
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
