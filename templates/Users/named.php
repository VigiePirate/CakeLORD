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
    <h1><?= __('Users with username like ') . __('“{0}”', [h(implode('"', $names))]) ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= __('State') ?></th>
                    <th><?= __('Username') ?></th>
                    <th><?= __('Rattery') ?></th>
                    <th><?= __('Localization') ?></th>
                    <th><?= __('Role') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><b><?= h($user->locked_symbol) ?></b></td>
                    <td><?= $this->Html->link($user->username, ['controller' => 'Users', 'action' => 'view', $user->id]) ?></td>
                    <td><?= h($user->main_rattery_name) ?></td>
                    <td><?= h($user->localization) ?></td>
                    <td><?= h($user->role->name) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
