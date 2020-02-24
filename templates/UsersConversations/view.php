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
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Number->format($usersConversation->user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Conversation Id') ?></th>
                    <td><?= $this->Number->format($usersConversation->conversation_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
