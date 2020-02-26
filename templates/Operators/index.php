<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operator[]|\Cake\Collection\CollectionInterface $operators
 */
?>
<div class="operators index content">
    <?= $this->Html->link(__('New Operator'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Operators') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('symbol') ?></th>
                    <th><?= $this->Paginator->sort('meaning') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($operators as $operator): ?>
                <tr>
                    <td><?= $this->Number->format($operator->id) ?></td>
                    <td><?= h($operator->symbol) ?></td>
                    <td><?= h($operator->meaning) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $operator->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $operator->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $operator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $operator->id)]) ?>
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
