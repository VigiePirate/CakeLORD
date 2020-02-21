<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatMessage[]|\Cake\Collection\CollectionInterface $backofficeRatMessages
 */
?>
<div class="backofficeRatMessages index content">
    <?= $this->Html->link(__('New Backoffice Rat Message'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Backoffice Rat Messages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('backoffice_rat_entry_id') ?></th>
                    <th><?= $this->Paginator->sort('staff_id') ?></th>
                    <th><?= $this->Paginator->sort('date_staff_comments') ?></th>
                    <th><?= $this->Paginator->sort('date_owner_comments') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($backofficeRatMessages as $backofficeRatMessage): ?>
                <tr>
                    <td><?= $this->Number->format($backofficeRatMessage->id) ?></td>
                    <td><?= $backofficeRatMessage->has('backoffice_rat_entry') ? $this->Html->link($backofficeRatMessage->backoffice_rat_entry->id, ['controller' => 'BackofficeRatEntries', 'action' => 'view', $backofficeRatMessage->backoffice_rat_entry->id]) : '' ?></td>
                    <td><?= $backofficeRatMessage->has('user') ? $this->Html->link($backofficeRatMessage->user->id, ['controller' => 'Users', 'action' => 'view', $backofficeRatMessage->user->id]) : '' ?></td>
                    <td><?= h($backofficeRatMessage->date_staff_comments) ?></td>
                    <td><?= h($backofficeRatMessage->date_owner_comments) ?></td>
                    <td><?= h($backofficeRatMessage->created) ?></td>
                    <td><?= h($backofficeRatMessage->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $backofficeRatMessage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $backofficeRatMessage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $backofficeRatMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatMessage->id)]) ?>
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
