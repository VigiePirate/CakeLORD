<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersConversation $usersConversation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-report.svg', [
          'url' => ['controller' => 'Conversations', 'action' => 'add'],
          'class' => 'side-nav-icon',
          'alt' => __('Report')]) ?>
      <?= $this->Html->image('/img/icon-help.svg', [
              'url' => ['controller' => 'Articles', 'action' => 'index'],
              'class' => 'side-nav-icon',
              'alt' => __('Help')]) ?>
            <?= $this->Html->link(__('Edit Users Conversation'), ['action' => 'edit', $usersConversation->user_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Users Conversation'), ['action' => 'delete', $usersConversation->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersConversation->user_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Users Conversation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
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
