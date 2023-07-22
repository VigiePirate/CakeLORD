<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatMessage $ratMessage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rat Message'), ['action' => 'edit', $ratMessage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rat Message'), ['action' => 'delete', $ratMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratMessage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rat Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rat Message'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratMessages view content">
            <h3><?= h($ratMessage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rat') ?></th>
                    <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->full_name, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $ratMessage->has('user') ? $this->Html->link($ratMessage->user->username, ['controller' => 'Users', 'action' => 'view', $ratMessage->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ratMessage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($ratMessage->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Staff Request') ?></th>
                    <td><?= $ratMessage->is_staff_request ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Automatically Generated') ?></th>
                    <td><?= $ratMessage->is_automatically_generated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Content') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($ratMessage->content)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
