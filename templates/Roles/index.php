<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<div class="roles index content">
    <?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Roles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('is_root') ?></th>
                    <th><?= $this->Paginator->sort('is_admin') ?></th>
                    <th><?= $this->Paginator->sort('is_staff') ?></th>
                    <th><?= $this->Paginator->sort('can_change_state') ?></th>
                    <th><?= $this->Paginator->sort('can_edit_others') ?></th>
                    <th><?= $this->Paginator->sort('can_edit_frozen') ?></th>
                    <th><?= $this->Paginator->sort('can_delete') ?></th>
                    <th><?= $this->Paginator->sort('can_configure') ?></th>
                    <th><?= $this->Paginator->sort('can_restore') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?= $this->Number->format($role->id) ?></td>
                    <td><?= h($role->name) ?></td>
                    <td><?= h($role->is_root) ?></td>
                    <td><?= h($role->is_admin) ?></td>
                    <td><?= h($role->is_staff) ?></td>
                    <td><?= h($role->can_change_state) ?></td>
                    <td><?= h($role->can_edit_others) ?></td>
                    <td><?= h($role->can_edit_frozen) ?></td>
                    <td><?= h($role->can_delete) ?></td>
                    <td><?= h($role->can_configure) ?></td>
                    <td><?= h($role->can_restore) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $role->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?>
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
