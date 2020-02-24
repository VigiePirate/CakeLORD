<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coat[]|\Cake\Collection\CollectionInterface $coats
 */
?>
<div class="coats index content">
    <?= $this->Html->link(__('New Coat'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Coats') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coats as $coat): ?>
                <tr>
                    <td><?= $this->Number->format($coat->id) ?></td>
                    <td><?= h($coat->name) ?></td>
                    <td><?= h($coat->picture) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $coat->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $coat->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coat->id)]) ?>
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
