<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LittersRat $littersRat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Litters Rat'), ['action' => 'edit', $littersRat->litters_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Litters Rat'), ['action' => 'delete', $littersRat->litters_id], ['confirm' => __('Are you sure you want to delete # {0}?', $littersRat->litters_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Litters Rats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Litters Rat'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="littersRats view content">
            <h3><?= h($littersRat->litters_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $littersRat->has('litter') ? $this->Html->link($littersRat->litter->id, ['controller' => 'Litters', 'action' => 'view', $littersRat->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat') ?></th>
                    <td><?= $littersRat->has('rat') ? $this->Html->link($littersRat->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $littersRat->rat->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
