<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathCausesPrimary[]|\Cake\Collection\CollectionInterface $deathCausesPrimary
 */
?>
<div class="deathCausesPrimary index content">
    <?= $this->Html->link(__('New Death Causes Primary'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Death Causes Primary') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name_fr') ?></th>
                    <th><?= $this->Paginator->sort('name_en') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deathCausesPrimary as $deathCausesPrimary): ?>
                <tr>
                    <td><?= $this->Number->format($deathCausesPrimary->id) ?></td>
                    <td><?= h($deathCausesPrimary->name_fr) ?></td>
                    <td><?= h($deathCausesPrimary->name_en) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $deathCausesPrimary->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deathCausesPrimary->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deathCausesPrimary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathCausesPrimary->id)]) ?>
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
