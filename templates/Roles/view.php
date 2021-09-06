<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roles view content">
            <h3><?= h($role->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($role->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($role->id) ?></td>
                </tr>
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
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($role->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Firstname') ?></th>
                            <th><?= __('Lastname') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Localization') ?></th>
                            <th><?= __('Avatar') ?></th>
                            <th><?= __('About Me') ?></th>
                            <th><?= __('Wants Newsletter') ?></th>
                            <th><?= __('Role Id') ?></th>
                            <th><?= __('Failed Login Attempts') ?></th>
                            <th><?= __('Failed Login Last Date') ?></th>
                            <th><?= __('Is Locked') ?></th>
                            <th><?= __('Passkey') ?></th>
                            <th><?= __('Staff Comments') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->password) ?></td>
                            <td><?= h($users->username) ?></td>
                            <td><?= h($users->firstname) ?></td>
                            <td><?= h($users->lastname) ?></td>
                            <td><?= h($users->birth_date) ?></td>
                            <td><?= h($users->sex) ?></td>
                            <td><?= h($users->localization) ?></td>
                            <td><?= h($users->avatar) ?></td>
                            <td><?= h($users->about_me) ?></td>
                            <td><?= h($users->wants_newsletter) ?></td>
                            <td><?= h($users->role_id) ?></td>
                            <td><?= h($users->failed_login_attempts) ?></td>
                            <td><?= h($users->failed_login_last_date) ?></td>
                            <td><?= h($users->is_locked) ?></td>
                            <td><?= h($users->passkey) ?></td>
                            <td><?= h($users->staff_comments) ?></td>
                            <td><?= h($users->created) ?></td>
                            <td><?= h($users->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
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
