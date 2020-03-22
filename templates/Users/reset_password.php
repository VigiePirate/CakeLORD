<!-- copied from a cake 3 tutorial, to be fixed -->

<?= $this->Flash->render() ?>

<div class="users form index content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= echo __('Enter New Password') ?></legend>
        <?= $this->Form->control('password', ['required' => true, 'autofocus' => true]) ?>
        <p class="helper">We recommend you to chose a password ofat least 12 characters with alphanumeric, lowercase, uppercase and/or special characters</p>
        <?= $this->Form->control('confirm_password', ['type' => 'password', 'required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Submit new password')); ?>
    <?= $this->Form->end() ?>
</div>
