<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContributionType[]|\Cake\Collection\CollectionInterface $contributionTypes
 */
?>
<div class="contributionTypes index content">
    <?= $this->Html->link(__('New Contribution Type'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('Contribution Types') ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('priority') ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contributionTypes as $contributionType): ?>
                <tr>
                    <td><?= $this->Number->format($contributionType->id) ?></td>
                    <td><?= h($contributionType->name) ?></td>
                    <td><?= $this->Number->format($contributionType->priority) ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'ContributionTypes', 'action' => 'edit', $contributionType->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit')
                        ])?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete')
                                ]),
                                ['action' => 'delete', $contributionType->id],
                                ['confirm' => __('Are you sure you want to delete contribution type # {0}?', $contributionType->id), 'escape' => false]
                            )
                        ?>
                    </td>
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
