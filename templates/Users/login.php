<!-- in /templates/Users/login.php -->
<?= $this->Flash->render() ?>

<?php $this->assign('title', __('Login') ?>

<div class="users form content">

    <h1><?= __('Login') ?></h1>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your registration email address and password') ?></legend>
        <?= $this->Form->control('email', ['required' => true, 'label' => __('Email address')]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>

    <div class="discrete-link">
    <?= $this->Html->link(__('Forgotten password?'), ['action' => 'lostPassword'], ['class' => 'discrete-link']) ?> — <?= $this->Html->link(__('Not registered?'), ['action' => 'register'], ['class' => 'discrete-link']) ?>
    </div>

    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>
