<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LitterSnapshot $litterSnapshot
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Litter Snapshot'), ['action' => 'edit', $litterSnapshot->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Litter Snapshot'), ['action' => 'delete', $litterSnapshot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litterSnapshot->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Litter Snapshots'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Litter Snapshot'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="litterSnapshots view content">
            <h3><?= h($litterSnapshot->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $litterSnapshot->has('litter') ? $this->Html->link($litterSnapshot->litter->id, ['controller' => 'Litters', 'action' => 'view', $litterSnapshot->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $litterSnapshot->has('state') ? $this->Html->link($litterSnapshot->state->name, ['controller' => 'States', 'action' => 'view', $litterSnapshot->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($litterSnapshot->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($litterSnapshot->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Data') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($litterSnapshot->data)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
