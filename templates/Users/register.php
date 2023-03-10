<?= $this->Flash->render() ?>

<div class="users form index content">
    <h1><?= __('Register') ?></h1>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('In order to create your account, please fill in this form') ?></legend>
        <?= $this->Form->control('username', [
            'label' => __('Username'),
            'required' => true,
            'error' => [
                'The provided value is invalid' => __('This username is already in use')
            ]
        ]) ?>
        <?= $this->Form->control('email', [
            'label' => __('Email address'),
            'required' => true,
            'error' => [
                'The provided value is invalid' =>  __('This email is already in use')
            ]
        ]) ?>
        <?= $this->Form->control('password', ['label' => __('Password'), 'required' => true]) ?>
        <legend><?= __('What is the meaning of the letter "R" in the LORD acronym?') ?></legend>
        <?= $this->Form->control('captcha', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('Register')); ?>
    <?= $this->Form->end() ?>
</div>
