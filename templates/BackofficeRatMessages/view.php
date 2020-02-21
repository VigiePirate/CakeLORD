<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatMessage $backofficeRatMessage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Backoffice Rat Message'), ['action' => 'edit', $backofficeRatMessage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Backoffice Rat Message'), ['action' => 'delete', $backofficeRatMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatMessage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Backoffice Rat Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Backoffice Rat Message'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="backofficeRatMessages view content">
            <h3><?= h($backofficeRatMessage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Backoffice Rat Entry') ?></th>
                    <td><?= $backofficeRatMessage->has('backoffice_rat_entry') ? $this->Html->link($backofficeRatMessage->backoffice_rat_entry->id, ['controller' => 'BackofficeRatEntries', 'action' => 'view', $backofficeRatMessage->backoffice_rat_entry->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $backofficeRatMessage->has('user') ? $this->Html->link($backofficeRatMessage->user->id, ['controller' => 'Users', 'action' => 'view', $backofficeRatMessage->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatMessage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Staff Comments') ?></th>
                    <td><?= h($backofficeRatMessage->date_staff_comments) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Owner Comments') ?></th>
                    <td><?= h($backofficeRatMessage->date_owner_comments) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($backofficeRatMessage->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($backofficeRatMessage->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Staff Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($backofficeRatMessage->staff_comments)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Owner Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($backofficeRatMessage->owner_comments)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
