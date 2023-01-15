<div class="button-small">
    <?= $this->Html->link(__('See Open Issues'), ['controller' => 'issues', 'action' => 'index'], ['class' => 'button button-small float-right']) ?>
    <?= $this->Html->link(__('See Closed Issues'), ['controller' => 'issues', 'action' => 'closed'], ['class' => 'button button-small float-right']) ?>
</div>

<h2><?= __('My Issues') ?></h2>
