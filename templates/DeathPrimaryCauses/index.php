<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathPrimaryCause[]|\Cake\Collection\CollectionInterface $deathPrimaryCauses
 */
?>
<div class="deathPrimaryCauses index content">
    <?= $this->Html->link(__('New Death Primary Cause'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Death Primary Causes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('is_infant') ?></th>
                    <th><?= $this->Paginator->sort('is_accident') ?></th>
                    <th><?= $this->Paginator->sort('is_oldster') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deathPrimaryCauses as $deathPrimaryCause): ?>
                <tr>
                    <td><?= $this->Number->format($deathPrimaryCause->id) ?></td>
                    <td><?= h($deathPrimaryCause->name) ?></td>
                    <td><?= h($deathPrimaryCause->is_infant) ?></td>
                    <td><?= h($deathPrimaryCause->is_accident) ?></td>
                    <td><?= h($deathPrimaryCause->is_oldster) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $deathPrimaryCause->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deathPrimaryCause->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deathPrimaryCause->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathPrimaryCause->id)]) ?>
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
