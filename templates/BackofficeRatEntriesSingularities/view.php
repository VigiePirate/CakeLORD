<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatEntriesSingularity $backofficeRatEntriesSingularity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Backoffice Rat Entries Singularity'), ['action' => 'edit', $backofficeRatEntriesSingularity->backoffice_rat_entries_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Backoffice Rat Entries Singularity'), ['action' => 'delete', $backofficeRatEntriesSingularity->backoffice_rat_entries_id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatEntriesSingularity->backoffice_rat_entries_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Backoffice Rat Entries Singularities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Backoffice Rat Entries Singularity'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="backofficeRatEntriesSingularities view content">
            <h3><?= h($backofficeRatEntriesSingularity->backoffice_rat_entries_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Backoffice Rat Entry') ?></th>
                    <td><?= $backofficeRatEntriesSingularity->has('backoffice_rat_entry') ? $this->Html->link($backofficeRatEntriesSingularity->backoffice_rat_entry->id, ['controller' => 'BackofficeRatEntries', 'action' => 'view', $backofficeRatEntriesSingularity->backoffice_rat_entry->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Singularity') ?></th>
                    <td><?= $backofficeRatEntriesSingularity->has('singularity') ? $this->Html->link($backofficeRatEntriesSingularity->singularity->id, ['controller' => 'Singularities', 'action' => 'view', $backofficeRatEntriesSingularity->singularity->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
