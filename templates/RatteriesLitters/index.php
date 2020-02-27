<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatteriesLitter[]|\Cake\Collection\CollectionInterface $ratteriesLitters
 */
?>
<div class="ratteriesLitters index content">
    <?= $this->Html->link(__('New Ratteries Litter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ratteries Litters') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('litter_id') ?></th>
                    <th><?= $this->Paginator->sort('litters_contributions_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratteriesLitters as $ratteriesLitter): ?>
                <tr>
                    <td><?= $ratteriesLitter->has('rattery') ? $this->Html->link($ratteriesLitter->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $ratteriesLitter->rattery->id]) : '' ?></td>
                    <td><?= $ratteriesLitter->has('litter') ? $this->Html->link($ratteriesLitter->litter->id, ['controller' => 'Litters', 'action' => 'view', $ratteriesLitter->litter->id]) : '' ?></td>
                    <td><?= $ratteriesLitter->has('litters_contribution') ? $this->Html->link($ratteriesLitter->litters_contribution->name, ['controller' => 'LittersContributions', 'action' => 'view', $ratteriesLitter->litters_contribution->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ratteriesLitter->rattery_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ratteriesLitter->rattery_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ratteriesLitter->rattery_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratteriesLitter->rattery_id)]) ?>
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
