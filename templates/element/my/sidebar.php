<h4 class="heading"><?= h($user->username) ?></h4>
<?= $this->Html->link(__('My Profile'), ['controller' => 'Users', 'action' => 'my'], ['class' => 'side-nav-item']) ?>
<?= $this->Html->link(__('My Rattery'), ['controller' => 'Ratteries', 'action' => 'my'], ['class' => 'side-nav-item']) ?>
<?= $this->Html->link(__('My Rats'), ['controller' => 'Rats', 'action' => 'my'], ['class' => 'side-nav-item']) ?>
<?= $this->Html->link(__('My Litters'), ['controller' => 'Litters', 'action' => 'my'], ['class' => 'side-nav-item']) ?>
