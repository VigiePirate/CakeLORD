<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersConversation $usersConversation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('List Users Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
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
