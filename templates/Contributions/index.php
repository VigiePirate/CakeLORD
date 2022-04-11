<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contribution[]|\Cake\Collection\CollectionInterface $contributions
 */
?>
<div class="contributions index content">
    <h1><?= __('All Contributions') ?></h3>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('litter_id') ?></th>
                    <th><?= $this->Paginator->sort('contribution_type_id') ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contributions as $contribution): ?>
                <tr>
                    <td><?= $this->Number->format($contribution->id) ?></td>
                    <td><?= $contribution->has('rattery') ? $this->Html->link($contribution->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $contribution->rattery->id]) : '' ?></td>
                    <td><?= $contribution->has('litter') ? $this->Html->link($contribution->litter->full_name, ['controller' => 'Litters', 'action' => 'view', $contribution->litter->id]) : '' ?></td>
                    <td><?= h($contribution->contribution_type->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'Contributions', 'action' => 'edit', $contribution->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit Contribution')
                        ])?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete Contribution')
                                ]),
                                ['action' => 'delete', $contribution->id],
                                ['confirm' => __('Are you sure you want to delete contribution # {0}?', $contribution->id), 'escape' => false]
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
