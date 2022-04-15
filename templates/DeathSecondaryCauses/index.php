<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause[]|\Cake\Collection\CollectionInterface $deathSecondaryCauses
 */
?>
<div class="deathSecondaryCauses index content">
    <?= $this->Html->link(__('New Death Cause'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Death Causes') ?></h1>
    <div class="table-responsive">
        <table class="summary">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('death_primary_cause_id', __('Category')) ?></th>
                    <th><?= $this->Paginator->sort('is_tumor', __('Tumor?')) ?></th>
                    <th class="actions-title col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deathSecondaryCauses as $deathSecondaryCause): ?>
                <tr>
                    <td><?= $this->Number->format($deathSecondaryCause->id) ?></td>
                    <td><?= $this->Html->link($deathSecondaryCause->name, ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $deathSecondaryCause->id]) ?></td>
                    <td><?= $deathSecondaryCause->has('death_primary_cause') ? h($deathSecondaryCause->death_primary_cause->name) : '' ?></td>
                    <td><?= $deathSecondaryCause->is_tumor ? '✓' : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'DeathSecondaryCauses', 'action' => 'edit', $deathSecondaryCause->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit Death Cause')]) ?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete Death Cause')
                                ]),
                                ['action' => 'delete', $deathSecondaryCause->id],
                                ['confirm' => __('Are you sure you want to delete country # {0}?', $deathSecondaryCause->id), 'escape' => false]
                            )
                        ?>
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
