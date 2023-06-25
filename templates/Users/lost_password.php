<?= $this->Flash->render() ?>

<?php $this->assign('title', __('Request new password') ?>

<div class="users form index content">

    <h1><?= __('Request new password') ?></h1>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')); ?>
    <?= $this->Form->end() ?>
</div>
