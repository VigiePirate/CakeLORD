<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LitterMessage $litterMessage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Litter Message'), ['action' => 'edit', $litterMessage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Litter Message'), ['action' => 'delete', $litterMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litterMessage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Litter Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Litter Message'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="litterMessages view content">
            <h3><?= h($litterMessage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $litterMessage->has('litter') ? $this->Html->link($litterMessage->litter->full_name, ['controller' => 'Litters', 'action' => 'view', $litterMessage->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $litterMessage->has('user') ? $this->Html->link($litterMessage->user->username, ['controller' => 'Users', 'action' => 'view', $litterMessage->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($litterMessage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($litterMessage->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Staff Request') ?></th>
                    <td><?= $litterMessage->is_staff_request ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Automatically Generated') ?></th>
                    <td><?= $litterMessage->is_automatically_generated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Content') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($litterMessage->content)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
