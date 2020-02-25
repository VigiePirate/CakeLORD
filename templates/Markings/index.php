<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Marking[]|\Cake\Collection\CollectionInterface $markings
 */
?>
<div class="markings index content">
    <?= $this->Html->link(__('New Marking'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Markings') ?></h3>
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
                <?php foreach ($markings as $marking): ?>
                <tr>
                    <td><?= $this->Number->format($marking->id) ?></td>
                    <td><?= h($marking->name) ?></td>
                    <td><?= h($marking->picture) ?></td>
                    <td><?= h($marking->genotype) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $marking->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $marking->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $marking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $marking->id)]) ?>
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
