<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contribution[]|\Cake\Collection\CollectionInterface $contributions
 */
?>
<?php $this->assign('title', __('All Contributions from {0}', [h($ratteries->name)])) ?>

<div class="contributions index content">
    <h1><?= __('All Contributions from {0}', [h($ratteries->name)]) ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Litters.birth_date', ['label' => __x('litter', 'Birth date')]) ?></th>
                    <th class="col-head"><?= __('Parents') ?></th>
                    <th><?= $this->Paginator->sort('ContributionTypes.name', ['label' => __('Contribution Type')]) ?></th>
                    <th><?= $this->Paginator->sort('Litters.pups_number', ['label' => __('Size')]) ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contributions as $contribution): ?>
                <tr>
                    <td><?= $contribution->has('litter') ? $this->Html->link($contribution->litter->birth_date, ['controller' => 'Litters', 'action' => 'view', $contribution->litter->id]) : '' ?></td>
                    <td><?= $contribution->has('litter') ? $contribution->litter->parents_name : '' ?></td>
                    <td><?= $contribution->has('contribution_type') ? h($contribution->contribution_type->name) : '' ?></td>
                    <td><?= $contribution->has('litter') ? $contribution->litter->pups_number : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'Contributions', 'action' => 'manageContributions', $contribution->litter->id],
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
