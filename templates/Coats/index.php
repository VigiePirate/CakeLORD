<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coat[]|\Cake\Collection\CollectionInterface $coats
 */
?>
<div class="coats index content">
    <?= $this->Html->link(__('New Coat'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Coats') ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th><?= $this->Paginator->sort('genotype') ?></th>
                    <th><?= $this->Paginator->sort('is_picture_mandatory', __('Mandatory picture?')) ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coats as $coat): ?>
                <tr>
                    <td><?= $this->Number->format($coat->id) ?></td>
                    <td><?= $this->Html->link(h($coat->name), ['action' => 'view', $coat->id]) ?></td>
                    <td><?= h($coat->picture) ?></td>
                    <td><?= h($coat->genotype) ?></td>
                    <td><?= $coat->is_picture_mandatory ? '✓' : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'Coats', 'action' => 'edit', $coat->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit Coat')
                        ])?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete Coat')
                                ]),
                                ['action' => 'delete', $coat->id],
                                ['confirm' => __('Are you sure you want to delete coat # {0}?', $coat->id), 'escape' => false]
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
