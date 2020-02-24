<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery[]|\Cake\Collection\CollectionInterface $ratteries
 */
?>
<div class="ratteries index content">
    <?= $this->Html->link(__('New Rattery'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ratteries') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('prefix') ?></th>
                    <th><?= $this->Paginator->sort('owner_id') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th><?= $this->Paginator->sort('is_alive') ?></th>
                    <th><?= $this->Paginator->sort('birth_year') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratteries as $rattery): ?>
                <tr>
                    <td><?= $this->Number->format($rattery->id) ?></td>
                    <td><?= h($rattery->name) ?></td>
                    <td><?= h($rattery->prefix) ?></td>
                    <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->id, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                    <td><?= h($rattery->picture) ?></td>
                    <td><?= h($rattery->is_alive) ?></td>
                    <td><?= h($rattery->birth_year) ?></td>
                    <td><?= h($rattery->created) ?></td>
                    <td><?= h($rattery->modified) ?></td>
                    <td><?= $this->Number->format($rattery->state_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rattery->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rattery->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rattery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rattery->id)]) ?>
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
