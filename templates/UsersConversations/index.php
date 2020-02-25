<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersConversation[]|\Cake\Collection\CollectionInterface $usersConversations
 */
?>
<div class="usersConversations index content">
    <?= $this->Html->link(__('New Users Conversation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users Conversations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('conversation_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersConversations as $usersConversation): ?>
                <tr>
                    <td><?= $usersConversation->has('user') ? $this->Html->link($usersConversation->user->username, ['controller' => 'Users', 'action' => 'view', $usersConversation->user->id]) : '' ?></td>
                    <td><?= $usersConversation->has('conversation') ? $this->Html->link($usersConversation->conversation->id, ['controller' => 'Conversations', 'action' => 'view', $usersConversation->conversation->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $usersConversation->user_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersConversation->user_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersConversation->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersConversation->user_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
