<?= $this->Flash->render() ?>

<div class="users form index content">

    <h1>Require new password</h1>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Request reset email')); ?>
    <?= $this->Form->end() ?>
</div>
