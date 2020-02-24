<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $ratterySnapshot
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rattery Snapshot'), ['action' => 'edit', $ratterySnapshot->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rattery Snapshot'), ['action' => 'delete', $ratterySnapshot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratterySnapshot->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rattery Snapshots'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rattery Snapshot'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratterySnapshots view content">
            <h3><?= h($ratterySnapshot->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ratterySnapshot->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery Id') ?></th>
                    <td><?= $this->Number->format($ratterySnapshot->rattery_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('State Id') ?></th>
                    <td><?= $this->Number->format($ratterySnapshot->state_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($ratterySnapshot->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Data') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($ratterySnapshot->data)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
