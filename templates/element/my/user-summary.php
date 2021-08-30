<div class="float-right">
    <?= $this->Html->image($user->avatar, ['alt' => $user->username, 'width' => '20%']) ?>
</div>
<h1><?= h($user->username) ?></h1>

<p><?= __('Welcome on your dashboard!')</p>

<p><?= h($user->email) ?> (<?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?>)</p>
