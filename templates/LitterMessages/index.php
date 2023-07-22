<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\LitterMessage> $litterMessages
 */
?>
<div class="litterMessages index content">
    <?= $this->Html->link(__('New Litter Message'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Litter Messages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('litter_id') ?></th>
                    <th><?= $this->Paginator->sort('from_user_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('is_staff_request') ?></th>
                    <th><?= $this->Paginator->sort('is_automatically_generated') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($litterMessages as $litterMessage): ?>
                <tr>
                    <td><?= $this->Number->format($litterMessage->id) ?></td>
                    <td><?= $litterMessage->has('litter') ? $this->Html->link($litterMessage->litter->full_name, ['controller' => 'Litters', 'action' => 'view', $litterMessage->litter->id]) : '' ?></td>
                    <td><?= $litterMessage->has('user') ? $this->Html->link($litterMessage->user->username, ['controller' => 'Users', 'action' => 'view', $litterMessage->user->id]) : '' ?></td>
                    <td><?= h($litterMessage->created) ?></td>
                    <td><?= h($litterMessage->is_staff_request) ?></td>
                    <td><?= h($litterMessage->is_automatically_generated) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $litterMessage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $litterMessage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $litterMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litterMessage->id)]) ?>
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
