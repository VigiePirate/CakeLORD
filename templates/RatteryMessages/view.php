<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatteryMessage $ratteryMessage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rattery Message'), ['action' => 'edit', $ratteryMessage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rattery Message'), ['action' => 'delete', $ratteryMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratteryMessage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rattery Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rattery Message'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratteryMessages view content">
            <h3><?= h($ratteryMessage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $ratteryMessage->has('rattery') ? $this->Html->link($ratteryMessage->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $ratteryMessage->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $ratteryMessage->has('user') ? $this->Html->link($ratteryMessage->user->username, ['controller' => 'Users', 'action' => 'view', $ratteryMessage->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ratteryMessage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($ratteryMessage->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Staff Request') ?></th>
                    <td><?= $ratteryMessage->is_staff_request ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Automatically Generated') ?></th>
                    <td><?= $ratteryMessage->is_automatically_generated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Content') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($ratteryMessage->content)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
