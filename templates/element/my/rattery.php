<div class="float-right">
    <?= $this->Html->image($user->avatar, ['alt' => $user->username]) ?>
</div>
<h3><?= h($user->username) ?></h3>
<p><?= __('Email:') ?> <?= h($user->email) ?> (<?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?>)</p>
<table>
<?php foreach($fields as $field): ?>
    <tr>
        <th><?= $field['name'] ?></th>
        <td><?= h($field['value']) ?></td>
    </tr>
<?php endforeach; ?>
</table>
