<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatEntriesSingularity[]|\Cake\Collection\CollectionInterface $backofficeRatEntriesSingularities
 */
?>
<div class="backofficeRatEntriesSingularities index content">
    <?= $this->Html->link(__('New Backoffice Rat Entries Singularity'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Backoffice Rat Entries Singularities') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('backoffice_rat_entries_id') ?></th>
                    <th><?= $this->Paginator->sort('singularities_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($backofficeRatEntriesSingularities as $backofficeRatEntriesSingularity): ?>
                <tr>
                    <td><?= $backofficeRatEntriesSingularity->has('backoffice_rat_entry') ? $this->Html->link($backofficeRatEntriesSingularity->backoffice_rat_entry->id, ['controller' => 'BackofficeRatEntries', 'action' => 'view', $backofficeRatEntriesSingularity->backoffice_rat_entry->id]) : '' ?></td>
                    <td><?= $backofficeRatEntriesSingularity->has('singularity') ? $this->Html->link($backofficeRatEntriesSingularity->singularity->id, ['controller' => 'Singularities', 'action' => 'view', $backofficeRatEntriesSingularity->singularity->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $backofficeRatEntriesSingularity->backoffice_rat_entries_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $backofficeRatEntriesSingularity->backoffice_rat_entries_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $backofficeRatEntriesSingularity->backoffice_rat_entries_id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatEntriesSingularity->backoffice_rat_entries_id)]) ?>
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
