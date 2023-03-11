<?= $this->Flash->render() ?>

<div class="users form index content">
    <h1><?= __('Reset Password') ?></h1>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Enter Old Password') ?></legend>
        <p class="helper"><?= __('Please confirm your identity by entering your current password.') ?></p>
        <?= $this->Form->control('email', [
            'required' => true,
            'value' => $user->email,
            'hidden' => true,
            'class' => 'hide-everywhere',
            'label' => [
                'class' => 'hide-everywhere',
                'text' => 'Hidden field for ID update'
            ],
            ])
        ?>
        <?= $this->Form->control('password', ['type' => 'password', 'required' => true, 'autofocus' => true]) ?>

        <legend><?= __('Enter New Password') ?></legend>
        <p class="helper"><?= __('We recommend you to chose a password of at least 12 characters with alphanumeric, lowercase, uppercase and/or special characters.') ?></p>
        <?= $this->Form->control('new_password', ['type' => 'password', 'required' => true, 'autofocus' => true]) ?>
        <?= $this->Form->control('confirm_password', ['type' => 'password', 'required' => true, 'autofocus' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('Submit new password')); ?>
    <?= $this->Form->end() ?>
</div>
