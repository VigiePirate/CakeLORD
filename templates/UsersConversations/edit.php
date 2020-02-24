<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersConversation $usersConversation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usersConversation->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersConversation->user_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usersConversations form content">
            <?= $this->Form->create($usersConversation) ?>
            <fieldset>
                <legend><?= __('Edit Users Conversation') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
