<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<div class="roles index content">
    <?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Roles') ?></h1>

    <h2><?= __('Staff level') ?></h2>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('is_root', __('Root?')) ?></th>
                    <th><?= $this->Paginator->sort('is_admin', __('Admin?')) ?></th>
                    <th><?= $this->Paginator->sort('is_staff', __('Staff?')) ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                <tr>

                    <td><?= $this->Number->format($role->id) ?></td>
                    <td><?= $this->Html->link($role->name, ['action' => 'view', $role->id]) ?></td>
                    <td><?= $role->is_root ? '✓' : '' ?></td>
                    <td><?= $role->is_admin ? '✓' : '' ?></td>
                    <td><?= $role->is_staff ? '✓' : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'Roles', 'action' => 'edit', $role->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit Role')
                        ])?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete Role')
                                ]),
                                ['action' => 'delete', $role->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'escape' => false]
                            )
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2><?= __('Permissions') ?></h2>
    <div class="table-responsive">
        <table class="summary roles">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('can_change_state', __('State editor')) ?></th>
                    <th><?= $this->Paginator->sort('can_edit_others', __('Others editor')) ?></th>
                    <th><?= $this->Paginator->sort('can_edit_frozen', __('Frozen editor')) ?></th>
                    <th><?= $this->Paginator->sort('can_delete', __('Deletor')) ?></th>
                    <th><?= $this->Paginator->sort('can_configure', __('Configurator')) ?></th>
                    <th><?= $this->Paginator->sort('can_restore', __('Restorator')) ?></th>
                    <th><?= $this->Paginator->sort('can_document', __('Documenter')) ?></th>
                    <th><?= $this->Paginator->sort('can_describe', __('Describer')) ?></th>
                    <th><?= $this->Paginator->sort('can_access_personal', __('Personal')) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?= $this->Number->format($role->id) ?></td>
                    <td><?= $this->Html->link($role->name, ['action' => 'view', $role->id]) ?></td>
                    <td><?= $role->can_change_state ? '✓' : '' ?></td>
                    <td><?= $role->can_edit_others ? '✓' : '' ?></td>
                    <td><?= $role->can_edit_frozen ? '✓' : '' ?></td>
                    <td><?= $role->can_delete ? '✓' : '' ?></td>
                    <td><?= $role->can_configure ? '✓' : ''?></td>
                    <td><?= $role->can_restore ? '✓' : '' ?></td>
                    <td><?= $role->can_document ? '✓' : '' ?></td>
                    <td><?= $role->can_describe ? '✓' : '' ?></td>
                    <td><?= $role->can_access_personal ? '✓' : '' ?></td>
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
