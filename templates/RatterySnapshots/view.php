<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatterySnapshot $ratterySnapshot
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-report.svg', [
          'url' => ['controller' => 'Conversations', 'action' => 'add'],
          'class' => 'side-nav-icon',
          'alt' => __('Report')]) ?>
      <?= $this->Html->image('/img/icon-help.svg', [
              'url' => ['controller' => 'Articles', 'action' => 'index'],
              'class' => 'side-nav-icon',
              'alt' => __('Help')]) ?>
            <?= $this->Html->link(__('Edit Rattery Snapshot'), ['action' => 'edit', $ratterySnapshot->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rattery Snapshot'), ['action' => 'delete', $ratterySnapshot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratterySnapshot->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rattery Snapshots'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rattery Snapshot'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratterySnapshots view content">
            <h3><?= h($ratterySnapshot->created) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $ratterySnapshot->has('rattery') ? $this->Html->link($ratterySnapshot->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $ratterySnapshot->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $ratterySnapshot->has('state') ? $this->Html->link($ratterySnapshot->state->name, ['controller' => 'States', 'action' => 'view', $ratterySnapshot->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ratterySnapshot->id) ?></td>
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
