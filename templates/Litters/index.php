<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter[]|\Cake\Collection\CollectionInterface $litters
 */
?>
<div class="litters index content">
    <?= $this->Html->link(__('New Litter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Litters') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('date_mating') ?></th>
                    <th><?= $this->Paginator->sort('date_birth') ?></th>
                    <th><?= $this->Paginator->sort('number_pups') ?></th>
                    <th><?= $this->Paginator->sort('number_pups_stillborn') ?></th>
                    <th><?= $this->Paginator->sort('rat_mother_id') ?></th>
                    <th><?= $this->Paginator->sort('rat_father_id') ?></th>
                    <th><?= $this->Paginator->sort('owner_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($litters as $litter): ?>
                <tr>
                    <td><?= $this->Number->format($litter->id) ?></td>
                    <td><?= h($litter->date_mating) ?></td>
                    <td><?= h($litter->date_birth) ?></td>
                    <td><?= $this->Number->format($litter->number_pups) ?></td>
                    <td><?= $this->Number->format($litter->number_pups_stillborn) ?></td>
                    <td><?= $this->Number->format($litter->rat_mother_id) ?></td>
                    <td><?= $this->Number->format($litter->rat_father_id) ?></td>
                    <td><?= $litter->has('user') ? $this->Html->link($litter->user->id, ['controller' => 'Users', 'action' => 'view', $litter->user->id]) : '' ?></td>
                    <td><?= h($litter->created) ?></td>
                    <td><?= h($litter->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $litter->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $litter->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $litter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litter->id)]) ?>
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
