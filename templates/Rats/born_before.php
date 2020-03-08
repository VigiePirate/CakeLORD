<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>
<div class="rats index content">
<h3><?= __('Rats born before') ?> "<?= h(implode('"',$bornBefore)) ?>"</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <th><?= $this->Paginator->sort('pedigree_identifier') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('pup_name') ?></th>
                    <th><?= $this->Paginator->sort('sex') ?></th>
                    <th><?= $this->Paginator->sort('birth_date') ?></th>
                    <th><?= $this->Paginator->sort('owner_user_id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rats as $rat): ?>
                <tr>
                    <td><?= $this->Html->image($rat->picture_thumbnail) ?></td>
                    <td><?= $this->Html->link(h($rat->pedigree_identifier), ['controller' => 'Rats', 'action' => 'view', $rat->id]) ?> <?= $rat->is_alive ? '†' : ''  ?></td>
                    <td><?= h($rat->name) ?></td>
                    <td><?= h($rat->pup_name) ?></td>
                    <td><?= h($rat->sex) ?></td>
                    <td><?= h($rat->birth_date) ?></td>
                    <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'OwnerUsers', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                    <td><?= $rat->has('rattery') ? $this->Html->link($rat->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $rat->rattery->id]) : '' ?></td>
                    <td><?= h($rat->state->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rat->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rat->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rat->id)]) ?>
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
