<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Roles',
                'object' => $role,
                'tooltip' => __('Browse role list'),
                'show_staff' => true
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="roles view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Roles') ?></div>
            </div>
            <h1><?= h($role->name) ?></h1>
            <h2><?= __('Reference information') ?></h2>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($role->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($role->name) ?></td>
                </tr>
            </table>
            <h2><?= __('Permissions') ?></h2>
            <table>
                <tr>
                    <th><?= __('Is Root') ?></th>
                    <td><?= $role->is_root ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Admin') ?></th>
                    <td><?= $role->is_admin ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Staff') ?></th>
                    <td><?= $role->is_staff ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Change State') ?></th>
                    <td><?= $role->can_change_state ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Edit Others') ?></th>
                    <td><?= $role->can_edit_others ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Edit Frozen') ?></th>
                    <td><?= $role->can_edit_frozen ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Delete') ?></th>
                    <td><?= $role->can_delete ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Configure') ?></th>
                    <td><?= $role->can_configure ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Restore') ?></th>
                    <td><?= $role->can_restore ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <?php if ($role->is_staff && !empty($role->users)) : ?>
                <h2><?= __('Related Users') ?></h2>        
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions col-head"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->users as $user) : ?>
                        <tr>
                            <td><?= $this->Html->link(h($user->username), ['action' => 'view', $user->id]) ?></td>
                            <td><?= h($user->created) ?></td>
                            <td><?= h($user->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                                    'url' => ['controller' => 'Users', 'action' => 'edit', $user->id],
                                    'class' => 'action-icon',
                                    'alt' => __('Edit User')
                                ])?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
