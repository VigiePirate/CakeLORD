<!-- in /templates/Users/lost-password.php -->
<div class="users form index content">
    <?= $this->Flash->render() ?>
    <h3>Lost Password</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Request reset email')); ?>
    <?= $this->Form->end() ?>
</div>
