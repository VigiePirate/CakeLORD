<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatsLitter[]|\Cake\Collection\CollectionInterface $ratsLitters
 */
?>
<div class="ratsLitters index content">
    <?= $this->Html->link(__('New Rats Litter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rats Litters') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('rat_id') ?></th>
                    <th><?= $this->Paginator->sort('litter_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratsLitters as $ratsLitter): ?>
                <tr>
                    <td><?= $ratsLitter->has('rat') ? $this->Html->link($ratsLitter->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratsLitter->rat->id]) : '' ?></td>
                    <td><?= $ratsLitter->has('litter') ? $this->Html->link($ratsLitter->litter->id, ['controller' => 'Litters', 'action' => 'view', $ratsLitter->litter->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ratsLitter->rat_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ratsLitter->rat_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ratsLitter->rat_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratsLitter->rat_id)]) ?>
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
