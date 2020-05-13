<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatteriesLitter $ratteriesLitter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ratteries Litter'), ['action' => 'edit', $ratteriesLitter->rattery_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ratteries Litter'), ['action' => 'delete', $ratteriesLitter->rattery_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratteriesLitter->rattery_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ratteries Litters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ratteries Litter'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratteriesLitters view content">
            <h3><?= h($ratteriesLitter->rattery_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $ratteriesLitter->has('rattery') ? $this->Html->link($ratteriesLitter->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $ratteriesLitter->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $ratteriesLitter->has('litter') ? $this->Html->link($ratteriesLitter->litter->full_name, ['controller' => 'Litters', 'action' => 'view', $ratteriesLitter->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Litters Contribution') ?></th>
                    <td><?= $ratteriesLitter->has('litters_contribution') ? $this->Html->link($ratteriesLitter->litters_contribution->name, ['controller' => 'LittersContributions', 'action' => 'view', $ratteriesLitter->litters_contribution->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
