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
                    <th><?= $this->Paginator->sort('mating_date') ?></th>
                    <th><?= $this->Paginator->sort('birth_date') ?></th>
                    <th><?= $this->Paginator->sort('pups_number') ?></th>
                    <th><?= $this->Paginator->sort('pups_number_stillborn') ?></th>
                    <th><?= $this->Paginator->sort('mother_rat_id') ?></th>
                    <th><?= $this->Paginator->sort('father_rat_id') ?></th>
                    <th><?= $this->Paginator->sort('creator_user_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($litters as $litter): ?>
                <tr>
                    <td><?= $this->Number->format($litter->id) ?></td>
                    <td><?= h($litter->mating_date) ?></td>
                    <td><?= h($litter->birth_date) ?></td>
                    <td><?= $this->Number->format($litter->pups_number) ?></td>
                    <td><?= $this->Number->format($litter->pups_number_stillborn) ?></td>
                    <td><?= $this->Number->format($litter->mother_rat_id) ?></td>
                    <td><?= $this->Number->format($litter->father_rat_id) ?></td>
                    <td><?= $this->Number->format($litter->creator_user_id) ?></td>
                    <td><?= h($litter->created) ?></td>
                    <td><?= h($litter->modified) ?></td>
                    <td><?= $this->Number->format($litter->state_id) ?></td>
                    <td><?= $this->Number->format($litter->rattery_id) ?></td>
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
