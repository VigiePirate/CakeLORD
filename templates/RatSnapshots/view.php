<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatSnapshot $ratSnapshot
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-fa-alert.svg', [
          'url' => ['controller' => 'Conversations', 'action' => 'add'],
          'class' => 'side-nav-icon',
          'alt' => __('Report')]) ?>
      <?= $this->Html->image('/img/icon-help.svg', [
              'url' => ['controller' => 'Articles', 'action' => 'index'],
              'class' => 'side-nav-icon',
              'alt' => __('Help')]) ?>
            <?= $this->Html->link(__('Edit Rat Snapshot'), ['action' => 'edit', $ratSnapshot->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rat Snapshot'), ['action' => 'delete', $ratSnapshot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratSnapshot->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rat Snapshots'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rat Snapshot'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratSnapshots view content">
            <h3><?= h($ratSnapshot->created) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rat') ?></th>
                    <td><?= $ratSnapshot->has('rat') ? $this->Html->link($ratSnapshot->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratSnapshot->rat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $ratSnapshot->has('state') ? $this->Html->link($ratSnapshot->state->name, ['controller' => 'States', 'action' => 'view', $ratSnapshot->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ratSnapshot->id) ?></td>
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
