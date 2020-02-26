<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compatibility[]|\Cake\Collection\CollectionInterface $compatibilities
 */
?>
<div class="compatibilities index content">
    <?= $this->Html->link(__('New Compatibility'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Compatibilities') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('left_genotype') ?></th>
                    <th><?= $this->Paginator->sort('operator_id') ?></th>
                    <th><?= $this->Paginator->sort('right_genotype') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compatibilities as $compatibility): ?>
                <tr>
                    <td><?= $this->Number->format($compatibility->id) ?></td>
                    <td><?= h($compatibility->left_genotype) ?></td>
                    <td><?= $compatibility->has('operator') ? $this->Html->link($compatibility->operator->id, ['controller' => 'Operators', 'action' => 'view', $compatibility->operator->id]) : '' ?></td>
                    <td><?= h($compatibility->right_genotype) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $compatibility->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $compatibility->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $compatibility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $compatibility->id)]) ?>
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
