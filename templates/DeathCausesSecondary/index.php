<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathCausesSecondary[]|\Cake\Collection\CollectionInterface $deathCausesSecondary
 */
?>
<div class="deathCausesSecondary index content">
    <?= $this->Html->link(__('New Death Causes Secondary'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Death Causes Secondary') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name_fr') ?></th>
                    <th><?= $this->Paginator->sort('name_en') ?></th>
                    <th><?= $this->Paginator->sort('deces_principal_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deathCausesSecondary as $deathCausesSecondary): ?>
                <tr>
                    <td><?= $this->Number->format($deathCausesSecondary->id) ?></td>
                    <td><?= h($deathCausesSecondary->name_fr) ?></td>
                    <td><?= h($deathCausesSecondary->name_en) ?></td>
                    <td><?= $deathCausesSecondary->has('death_causes_primary') ? $this->Html->link($deathCausesSecondary->death_causes_primary->id, ['controller' => 'DeathCausesPrimary', 'action' => 'view', $deathCausesSecondary->death_causes_primary->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $deathCausesSecondary->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deathCausesSecondary->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deathCausesSecondary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathCausesSecondary->id)]) ?>
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
