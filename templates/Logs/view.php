<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log $log
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('Edit Log'), ['action' => 'edit', $log->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Log'), ['action' => 'delete', $log->id], ['confirm' => __('Are you sure you want to delete # {0}?', $log->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Log'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="logs view content">
            <h3><?= h($log->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($log->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($log->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Event') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($log->event)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
