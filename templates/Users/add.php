<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('sex');
                    echo $this->Form->control('name_first');
                    echo $this->Form->control('name_last');
                    echo $this->Form->control('login');
                    echo $this->Form->control('date_birth', ['empty' => true]);
                    echo $this->Form->control('newsletter');
                    echo $this->Form->control('roles._ids', ['options' => $roles, 'empty' => true]);
                    echo $this->Form->control('is_locked');
                    echo $this->Form->control('failed_login_attempts');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
