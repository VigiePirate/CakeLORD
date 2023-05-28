<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index content">
    <?php if ($show_staff) : ?>
        <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <?php endif ; ?>
    <h1><?= __('All Users') ?></h1>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <?php if ($show_staff) : ?>
                        <th><?= $this->Paginator->sort('id') ?></th>
                    <?php endif ; ?>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('role_id') ?></th>
                    <?php if ($show_staff) : ?>
                        <th><?= $this->Paginator->sort('email') ?></th>
                        <th><?= $this->Paginator->sort('is_locked', __('Locked?')) ?></th>
                        <th><?= $this->Paginator->sort('created', __x('user', 'Created')) ?></th>
                        <th><?= $this->Paginator->sort('modified', __x('user', 'Modified')) ?></th>
                        <th><?= $this->Paginator->sort('successful_login_last_date', __x('date', 'Last login')) ?></th>
                    <?php endif ?>
                    <?php if ($show_staff) : ?>
                        <th class="actions col-head"><?= __('Actions') ?></th>
                    <?php endif ; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <?php if ($show_staff) : ?>
                        <td><?= $this->Number->format($user->id) ?></td>
                    <?php endif ; ?>
                    <td><?= $this->Html->link(h($user->username), ['action' => 'view', $user->id], ['escape' => false]) ?></td>
                    <td><?= $user->has('role') ? $user->role->name : '' ?></td>
                    <?php if ($show_staff) : ?>
                        <td><?= h($user->email) ?></td>
                        <td><?= $user->locked_symbol ?></td>
                        <td><?= $user->created->i18nFormat('dd/MM/yyyy') ?></td>
                        <td><?= $user->modified->i18nFormat('dd/MM/yyyy') ?></td>
                        <td><?= is_null($user->successful_login_last_date) ? __('N/A') : $user->successful_login_last_date->i18nFormat('dd/MM/yyyy') ?></td>
                    <?php endif ?>
                    <?php if ($show_staff) : ?>
                        <td class="actions">
                            <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                                'url' => ['controller' => 'Users', 'action' => 'edit', $user->id],
                                'class' => 'action-icon',
                                'alt' => __('Edit User')]) ?>
                            <?= $this->Form->postLink(
                                    $this->Html->image('/img/icon-delete.svg', [
                                        'class' => 'action-icon',
                                        'alt' => __('Delete User')
                                    ]),
                                    ['action' => 'delete', $user->id],
                                    ['confirm' => __('Are you sure you want to delete country # {0}?', $user->id), 'escape' => false]
                                )
                            ?>
                        </td>
                    <?php endif ?>
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
