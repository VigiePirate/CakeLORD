<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LitterSnapshot[]|\Cake\Collection\CollectionInterface $litterSnapshots
 */
?>
<div class="litterSnapshots index content">
    <?= $this->Html->link(__('New Litter Snapshot'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Litter Snapshots') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('litter_id') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($litterSnapshots as $litterSnapshot): ?>
                <tr>
                    <td><?= $this->Number->format($litterSnapshot->id) ?></td>
                    <td><?= h($litterSnapshot->created) ?></td>
                    <td><?= $litterSnapshot->has('litter') ? $this->Html->link($litterSnapshot->litter->id, ['controller' => 'Litters', 'action' => 'view', $litterSnapshot->litter->id]) : '' ?></td>
                    <td><?= $litterSnapshot->has('state') ? $this->Html->link($litterSnapshot->state->name, ['controller' => 'States', 'action' => 'view', $litterSnapshot->state->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $litterSnapshot->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $litterSnapshot->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $litterSnapshot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litterSnapshot->id)]) ?>
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
