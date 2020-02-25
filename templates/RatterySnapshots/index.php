<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatterySnapshot[]|\Cake\Collection\CollectionInterface $ratterySnapshots
 */
?>
<div class="ratterySnapshots index content">
    <?= $this->Html->link(__('New Rattery Snapshot'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rattery Snapshots') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratterySnapshots as $ratterySnapshot): ?>
                <tr>
                    <td><?= $this->Number->format($ratterySnapshot->id) ?></td>
                    <td><?= h($ratterySnapshot->created) ?></td>
                    <td><?= $ratterySnapshot->has('rattery') ? $this->Html->link($ratterySnapshot->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $ratterySnapshot->rattery->id]) : '' ?></td>
                    <td><?= $ratterySnapshot->has('state') ? $this->Html->link($ratterySnapshot->state->name, ['controller' => 'States', 'action' => 'view', $ratterySnapshot->state->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ratterySnapshot->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ratterySnapshot->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ratterySnapshot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratterySnapshot->id)]) ?>
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
