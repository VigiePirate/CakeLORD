<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $conversation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Conversation'), ['action' => 'edit', $conversation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Conversation'), ['action' => 'delete', $conversation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conversation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Conversation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="conversations view content">
            <h3><?= h($conversation->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($conversation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery Id') ?></th>
                    <td><?= $this->Number->format($conversation->rattery_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Litter Id') ?></th>
                    <td><?= $this->Number->format($conversation->litter_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Id') ?></th>
                    <td><?= $this->Number->format($conversation->rat_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($conversation->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($conversation->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $conversation->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
