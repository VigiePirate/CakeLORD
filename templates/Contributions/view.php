<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contribution $contribution
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('Edit Contribution'), ['action' => 'edit', $contribution->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contribution'), ['action' => 'delete', $contribution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contribution->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contributions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contribution'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contributions view content">
            <h3><?= h($contribution->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $contribution->has('rattery') ? $this->Html->link($contribution->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $contribution->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $contribution->has('litter') ? $this->Html->link($contribution->litter->full_name, ['controller' => 'Litters', 'action' => 'view', $contribution->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Contribution Type') ?></th>
                    <td><?= $contribution->has('contribution_type') ? $this->Html->link($contribution->contribution_type->name, ['controller' => 'ContributionTypes', 'action' => 'view', $contribution->contribution_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contribution->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
