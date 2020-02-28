<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LittersRat[]|\Cake\Collection\CollectionInterface $littersRats
 */
?>
<div class="littersRats index content">
    <?= $this->Html->link(__('New Litters Rat'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Litters Rats') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('litters_id') ?></th>
                    <th><?= $this->Paginator->sort('rats_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($littersRats as $littersRat): ?>
                <tr>
                    <td><?= $littersRat->has('litter') ? $this->Html->link($littersRat->litter->id, ['controller' => 'Litters', 'action' => 'view', $littersRat->litter->id]) : '' ?></td>
                    <td><?= $littersRat->has('rat') ? $this->Html->link($littersRat->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $littersRat->rat->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $littersRat->litters_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $littersRat->litters_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $littersRat->litters_id], ['confirm' => __('Are you sure you want to delete # {0}?', $littersRat->litters_id)]) ?>
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
