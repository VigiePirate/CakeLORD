<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RatMessage> $ratMessages
 */
?>
<div class="ratMessages index content">
    <?= $this->Html->link(__('New Rat Message'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rat Messages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rat_id') ?></th>
                    <th><?= $this->Paginator->sort('from_user_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('is_staff_request') ?></th>
                    <th><?= $this->Paginator->sort('is_automatically_generated') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratMessages as $ratMessage): ?>
                <tr>
                    <td><?= $this->Number->format($ratMessage->id) ?></td>
                    <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->full_name, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?></td>
                    <td><?= $ratMessage->has('user') ? $this->Html->link($ratMessage->user->username, ['controller' => 'Users', 'action' => 'view', $ratMessage->user->id]) : '' ?></td>
                    <td><?= h($ratMessage->created) ?></td>
                    <td><?= h($ratMessage->is_staff_request) ?></td>
                    <td><?= h($ratMessage->is_automatically_generated) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ratMessage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ratMessage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ratMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratMessage->id)]) ?>
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
