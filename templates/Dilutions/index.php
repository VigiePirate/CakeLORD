<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dilution[]|\Cake\Collection\CollectionInterface $dilutions
 */
?>
<div class="dilutions index content">
    <?= $this->Html->link(__('New Dilution'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Dilutions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th><?= $this->Paginator->sort('genotype') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dilutions as $dilution): ?>
                <tr>
                    <td><?= $this->Number->format($dilution->id) ?></td>
                    <td><?= h($dilution->name) ?></td>
                    <td><?= h($dilution->picture) ?></td>
                    <td><?= h($dilution->genotype) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $dilution->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dilution->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dilution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dilution->id)]) ?>
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
