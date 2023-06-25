<?= $this->Flash->render() ?>

<?php $this->assign('title', __('Sign up')) ?>

<div class="users form index content">
    <h1><?= __('Register') ?></h1>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('In order to create your account, please fill in this form') ?></legend>

        <?= $this->Form->control('nickname', [
            'label' => __('Username'),
            'required' => true,
            'error' => [
                'The provided value is invalid' => __('This username is already in use')
            ]
        ]) ?>

        <?= $this->Form->control('email', [
            'label' => __('Email address'),
            'required' => true,
            'autocomplete' => 'off',
            'error' => [
                'The provided value is invalid' =>  __('This email is already in use')
            ]
        ]) ?>
        <?= $this->Form->control('password', ['label' => __('Password'), 'required' => true]) ?>

        <?= $this->Form->control('captcha', ['label' => __('What is the meaning of the letter "R" in the LORD acronym?'), 'required' => true]) ?>

        <?php
            echo $this->Form->control('consent', [
                'class' => 'consent',
                'type' => 'checkbox',
                'default' => false,
                'required' => true,
                'label' => [
                    'text' => __('I have read the site’s {0} and its {1} and I agree to all terms and conditions.', [
                        $this->Html->link(__('Legal Notice'), ['controller' => 'Articles', 'action' => 'view', 9]),
                        $this->Html->link(__('Code of conduct'), ['controller' => 'Articles', 'action' => 'view', 9])
                    ]),
                    'class' => 'consent'
                ],
                'escape' => false
            ]);
        ?>

    </fieldset>

    <?= $this->Form->button(__('Register')); ?>
    <?= $this->Form->end() ?>
</div>
