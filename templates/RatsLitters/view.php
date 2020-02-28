<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatsLitter $ratsLitter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rats Litter'), ['action' => 'edit', $ratsLitter->rat_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rats Litter'), ['action' => 'delete', $ratsLitter->rat_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratsLitter->rat_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rats Litters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rats Litter'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratsLitters view content">
            <h3><?= h($ratsLitter->rat_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rat') ?></th>
                    <td><?= $ratsLitter->has('rat') ? $this->Html->link($ratsLitter->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratsLitter->rat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $ratsLitter->has('litter') ? $this->Html->link($ratsLitter->litter->id, ['controller' => 'Litters', 'action' => 'view', $ratsLitter->litter->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
