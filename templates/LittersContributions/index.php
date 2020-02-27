<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LittersContribution[]|\Cake\Collection\CollectionInterface $littersContributions
 */
?>
<div class="littersContributions index content">
    <?= $this->Html->link(__('New Litters Contribution'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Litters Contributions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('priority') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($littersContributions as $littersContribution): ?>
                <tr>
                    <td><?= $this->Number->format($littersContribution->id) ?></td>
                    <td><?= h($littersContribution->name) ?></td>
                    <td><?= $this->Number->format($littersContribution->priority) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $littersContribution->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $littersContribution->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $littersContribution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $littersContribution->id)]) ?>
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
