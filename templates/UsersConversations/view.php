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
            <?= $this->Html->link(__('Edit Users Conversation'), ['action' => 'edit', $usersConversation->user_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Users Conversation'), ['action' => 'delete', $usersConversation->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersConversation->user_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Users Conversation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usersConversations view content">
            <h3><?= h($usersConversation->user_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $usersConversation->has('user') ? $this->Html->link($usersConversation->user->username, ['controller' => 'Users', 'action' => 'view', $usersConversation->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Conversation') ?></th>
                    <td><?= $usersConversation->has('conversation') ? $this->Html->link($usersConversation->conversation->id, ['controller' => 'Conversations', 'action' => 'view', $usersConversation->conversation->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
