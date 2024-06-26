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
                'show_staff' => true,
                'user' => $user
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
                    <th><?= __('Is root') ?></th>
                    <td><?= $role->is_root ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is administrator') ?></th>
                    <td><?= $role->is_admin ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is a staff member') ?></th>
                    <td><?= $role->is_staff ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can change sheet states') ?></th>
                    <td><?= $role->can_change_state ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can edit other users and their sheets') ?></th>
                    <td><?= $role->can_edit_others ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can edit frozen sheets') ?></th>
                    <td><?= $role->can_edit_frozen ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can delete sheets') ?></th>
                    <td><?= $role->can_delete ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can configure system (states, roles)') ?></th>
                    <td><?= $role->can_configure ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can restore snapshots') ?></th>
                    <td><?= $role->can_restore ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can add and edit documentation (articles, FAQs...)') ?></th>
                    <td><?= $role->can_document ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can add and edit descriptive sheets (varieties, death causes...)') ?></th>
                    <td><?= $role->can_describe ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can access other users personal data') ?></th>
                    <td><?= $role->can_access_personal ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <?php if ($role->is_staff && !empty($role->users)) : ?>
                <h2><?= __('Related Users') ?></h2>
                <div class="table-responsive">
                    <table class="condensed unfold">
                        <tr>
                            <th><?= __('Username') ?></th>
                            <th><?= __x('user', 'Created') ?></th>
                            <th><?= __x('user', 'Modified') ?></th>
                            <th class="actions col-head"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->users as $user) : ?>
                        <tr>
                            <td><?= $this->Html->link(h($user->username), ['controller' => 'Users', 'action' => 'view', $user->id]) ?></td>
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
