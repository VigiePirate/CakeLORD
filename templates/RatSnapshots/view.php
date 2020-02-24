<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $ratSnapshot
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rat Snapshot'), ['action' => 'edit', $ratSnapshot->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rat Snapshot'), ['action' => 'delete', $ratSnapshot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratSnapshot->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rat Snapshots'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rat Snapshot'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratSnapshots view content">
            <h3><?= h($ratSnapshot->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ratSnapshot->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Id') ?></th>
                    <td><?= $this->Number->format($ratSnapshot->rat_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('State Id') ?></th>
                    <td><?= $this->Number->format($ratSnapshot->state_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($ratSnapshot->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Data') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($ratSnapshot->data)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
