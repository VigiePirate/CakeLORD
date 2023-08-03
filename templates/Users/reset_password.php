<?= $this->Flash->render() ?>

<?php $this->assign('title', __('Reset Password')) ?>

<div class="users form index content">
    <h1><?= __('Reset Password') ?></h1>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Enter New Password') ?></legend>
        <p class="helper"><?= __('We recommend you to chose a password of at least 12 characters with alphanumeric, lowercase, uppercase and/or special characters.') ?></p>
        <?= $this->Form->control('new_password', ['label' => __('New password'), 'type' => 'password', 'required' => true, 'autofocus' => true]) ?>
        <?= $this->Form->control('confirm_password', ['label' => __('Confirm new password'), 'type' => 'password', 'required' => true, 'autofocus' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('Submit new password')); ?>
    <?= $this->Form->end() ?>
</div>
