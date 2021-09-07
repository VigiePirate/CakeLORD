<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause[]|\Cake\Collection\CollectionInterface $deathSecondaryCauses
 */
?>
<div class="deathSecondaryCauses index content">
    <?= $this->Html->link(__('New Death Secondary Cause'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Death Secondary Causes') ?></h1>
    <div class="table-responsive">
        <table class="summary">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('death_primary_cause_id') ?></th>
                    <th><?= $this->Paginator->sort('is_tumor') ?></th>
                    <th class="actions-title"><?= $this->Html->image('/img/icon-fa-action.svg', ['class' => 'action-icon'])?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deathSecondaryCauses as $deathSecondaryCause): ?>
                <tr>
                    <td><?= $this->Number->format($deathSecondaryCause->id) ?></td>
                    <td><?= h($deathSecondaryCause->name) ?></td>
                    <td><?= $deathSecondaryCause->has('death_primary_cause') ? $this->Html->link($deathSecondaryCause->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $deathSecondaryCause->death_primary_cause->id]) : '' ?></td>
                    <td><?= h($deathSecondaryCause->is_tumor) ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-view.svg', [
                            'url' => ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $deathSecondaryCause->id],
                            'class' => 'action-icon',
                            'alt' => __('See Rat')]) ?>
                        <?= $this->Html->image('/img/icon-edit-as-staff.svg', [
                            'url' => ['controller' => 'DeathSecondaryCauses', 'action' => 'edit', $deathSecondaryCause->id],
                            'class' => 'action-icon',
                            'alt' => __('See Rat')]) ?>
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
