<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatteryMessage $backofficeRatteryMessage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Backoffice Rattery Message'), ['action' => 'edit', $backofficeRatteryMessage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Backoffice Rattery Message'), ['action' => 'delete', $backofficeRatteryMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatteryMessage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Backoffice Rattery Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Backoffice Rattery Message'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="backofficeRatteryMessages view content">
            <h3><?= h($backofficeRatteryMessage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $backofficeRatteryMessage->has('rattery') ? $this->Html->link($backofficeRatteryMessage->rattery->name, ['controller' => 'Ratteries', 'action' => 'view', $backofficeRatteryMessage->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $backofficeRatteryMessage->has('user') ? $this->Html->link($backofficeRatteryMessage->user->id, ['controller' => 'Users', 'action' => 'view', $backofficeRatteryMessage->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatteryMessage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($backofficeRatteryMessage->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($backofficeRatteryMessage->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Staff Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($backofficeRatteryMessage->staff_comments)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Owner Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($backofficeRatteryMessage->owner_comments)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
