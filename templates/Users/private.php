<!-- In templates/Ratteries/prefixed.php -->
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery[]|\Cake\Collection\CollectionInterface $ratteries
 */
?>

<div class="ratteries index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Search Results') ?></div>
    </div>
    <h1><?= __('Users with username, name or mail like ') . __('“{0}”', [h(implode('"', $names))]) ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('firstname') ?></th>
                    <th><?= $this->Paginator->sort('lastname') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('successful_login_last_date', __x('date', 'Last login')) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Html->link($user->username, ['controller' => 'Users', 'action' => 'view', $user->id]) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= ucfirst(mb_strtolower(h($user->firstname))) ?></td>
                    <td><?= ucfirst(mb_strtolower(h($user->lastname))) ?></td>
                    <td><?= h($user->role->name) ?></td>
                    <td><?= is_null($user->successful_login_last_date) ? __('N/A') : $user->successful_login_last_date->i18nFormat('dd/MM/yyyy') ?></td>
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
