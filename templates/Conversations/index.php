<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conversation[]|\Cake\Collection\CollectionInterface $conversations
 */
?>
<div class="conversations index content">
    <?= $this->Html->link(__('New Conversation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Conversations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('litter_id') ?></th>
                    <th><?= $this->Paginator->sort('rat_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($conversations as $conversation): ?>
                <tr>
                    <td><?= $this->Number->format($conversation->id) ?></td>
                    <td><?= $conversation->has('rattery') ? $this->Html->link($conversation->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $conversation->rattery->id]) : '' ?></td>
                    <td><?= $conversation->has('litter') ? $this->Html->link($conversation->litter->id, ['controller' => 'Litters', 'action' => 'view', $conversation->litter->id]) : '' ?></td>
                    <td><?= $conversation->has('rat') ? $this->Html->link($conversation->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $conversation->rat->id]) : '' ?></td>
                    <td><?= h($conversation->created) ?></td>
                    <td><?= h($conversation->modified) ?></td>
                    <td><?= h($conversation->is_active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $conversation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $conversation->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $conversation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conversation->id)]) ?>
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
