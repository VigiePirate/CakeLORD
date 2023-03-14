<?= $this->Flash->render() ?>

<div class="users form index content">
    <h1><?= __('Reset Email') ?></h1>
    <?= $this->Form->create(null, ['autocomplete' => 'off']) ?>
    <fieldset>
        <?php if (!is_null($user)) : ?>
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
            <?= $this->Form->control('password', ['type' => 'password', 'required' => true, 'value' => null]) ?>
        <?php endif; ?>

        <legend><?= __('Enter New Email') ?></legend>
        <p class="helper"><?= __('Please note that an activation link message will be sent to this address. If the entered address is invalid, your account will be locked.') ?></p>
        <?= $this->Form->control('new_email', ['type' => 'email', 'required' => true, 'autocomplete' => 'new-email']) ?>
        <?= $this->Form->control('confirm_email', ['type' => 'email', 'required' => true, 'autocomplete' => 'do-not-autofill']) ?>
    </fieldset>
    <?= $this->Form->button(__('Submit new email')); ?>
    <?= $this->Form->end() ?>
</div>
