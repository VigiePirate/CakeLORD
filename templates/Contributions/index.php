<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contribution[]|\Cake\Collection\CollectionInterface $contributions
 */
?>
<div class="contributions index content">
    <?= $this->Html->link(__('New Contribution'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contributions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('litter_id') ?></th>
                    <th><?= $this->Paginator->sort('contribution_type_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contributions as $contribution): ?>
                <tr>
                    <td><?= $this->Number->format($contribution->id) ?></td>
                    <td><?= $contribution->has('rattery') ? $this->Html->link($contribution->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $contribution->rattery->id]) : '' ?></td>
                    <td><?= $contribution->has('litter') ? $this->Html->link($contribution->litter->full_name, ['controller' => 'Litters', 'action' => 'view', $contribution->litter->id]) : '' ?></td>
                    <td><?= $contribution->has('contribution_type') ? $this->Html->link($contribution->contribution_type->name, ['controller' => 'ContributionTypes', 'action' => 'view', $contribution->contribution_type->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contribution->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contribution->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contribution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contribution->id)]) ?>
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
