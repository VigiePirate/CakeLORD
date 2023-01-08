<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Issue'), ['action' => 'edit', $issue->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Issue'), ['action' => 'delete', $issue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $issue->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Issues'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Issue'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="issues view content">
            <h3><?= h($issue->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Url') ?></th>
                    <td><?= h($issue->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $issue->has('user') ? $this->Html->link($issue->user->username, ['controller' => 'Users', 'action' => 'view', $issue->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($issue->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('From User Id') ?></th>
                    <td><?= $this->Number->format($issue->from_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($issue->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Closed') ?></th>
                    <td><?= h($issue->closed) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Open') ?></th>
                    <td><?= $issue->is_open ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Complaint') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($issue->complaint)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Handling') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($issue->handling)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
