<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause[]|\Cake\Collection\CollectionInterface $deathSecondaryCauses
 */
?>
<div class="deathSecondaryCauses index content">
    <?= $this->Html->link(__('New Death Secondary Cause'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Death Secondary Causes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name_fr') ?></th>
                    <th><?= $this->Paginator->sort('name_en') ?></th>
                    <th><?= $this->Paginator->sort('death_primary_cause_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deathSecondaryCauses as $deathSecondaryCause): ?>
                <tr>
                    <td><?= $this->Number->format($deathSecondaryCause->id) ?></td>
                    <td><?= h($deathSecondaryCause->name_fr) ?></td>
                    <td><?= h($deathSecondaryCause->name_en) ?></td>
                    <td><?= $deathSecondaryCause->has('death_primary_cause') ? $this->Html->link($deathSecondaryCause->death_primary_cause->id, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $deathSecondaryCause->death_primary_cause->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $deathSecondaryCause->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deathSecondaryCause->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deathSecondaryCause->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathSecondaryCause->id)]) ?>
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
