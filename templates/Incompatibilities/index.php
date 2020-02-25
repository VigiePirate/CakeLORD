<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Incompatibility[]|\Cake\Collection\CollectionInterface $incompatibilities
 */
?>
<div class="incompatibilities index content">
    <?= $this->Html->link(__('New Incompatibility'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Incompatibilities') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('genotype1') ?></th>
                    <th><?= $this->Paginator->sort('genotype2') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($incompatibilities as $incompatibility): ?>
                <tr>
                    <td><?= $this->Number->format($incompatibility->id) ?></td>
                    <td><?= h($incompatibility->genotype1) ?></td>
                    <td><?= h($incompatibility->genotype2) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $incompatibility->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $incompatibility->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $incompatibility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incompatibility->id)]) ?>
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
