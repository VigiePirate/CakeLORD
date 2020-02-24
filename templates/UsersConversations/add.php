<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $usersConversation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usersConversations form content">
            <?= $this->Form->create($usersConversation) ?>
            <fieldset>
                <legend><?= __('Add Users Conversation') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
