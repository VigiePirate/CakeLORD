<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatSnapshot[]|\Cake\Collection\CollectionInterface $ratSnapshots
 */
?>
<div class="ratSnapshots index content">
    <?= $this->Html->link(__('New Rat Snapshot'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rat Snapshots') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rat_id') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratSnapshots as $ratSnapshot): ?>
                <tr>
                    <td><?= $this->Number->format($ratSnapshot->id) ?></td>
                    <td><?= $ratSnapshot->has('rat') ? $this->Html->link($ratSnapshot->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratSnapshot->rat->id]) : '' ?></td>
                    <td><?= $ratSnapshot->has('state') ? $this->Html->link($ratSnapshot->state->name, ['controller' => 'States', 'action' => 'view', $ratSnapshot->state->id]) : '' ?></td>
                    <td><?= h($ratSnapshot->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ratSnapshot->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ratSnapshot->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ratSnapshot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratSnapshot->id)]) ?>
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
