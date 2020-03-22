<?= $this->Flash->render() ?>

<div class="users form index content">
    <h3>Reset Password</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Enter New Password') ?></legend>
        <?= $this->Form->control('password', ['required' => true, 'autofocus' => true]) ?>
        <p class="helper">We recommend you to chose a password of at least 12 characters with alphanumeric, lowercase, uppercase and/or special characters</p>
        <?= $this->Form->control('confirm_password', ['type' => 'password', 'required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Submit new password')); ?>
    <?= $this->Form->end() ?>
</div>
