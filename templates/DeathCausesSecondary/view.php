<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathCausesSecondary $deathCausesSecondary
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Death Causes Secondary'), ['action' => 'edit', $deathCausesSecondary->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Death Causes Secondary'), ['action' => 'delete', $deathCausesSecondary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathCausesSecondary->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Death Causes Secondary'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Death Causes Secondary'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deathCausesSecondary view content">
            <h3><?= h($deathCausesSecondary->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name Fr') ?></th>
                    <td><?= h($deathCausesSecondary->name_fr) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name En') ?></th>
                    <td><?= h($deathCausesSecondary->name_en) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Causes Primary') ?></th>
                    <td><?= $deathCausesSecondary->has('death_causes_primary') ? $this->Html->link($deathCausesSecondary->death_causes_primary->id, ['controller' => 'DeathCausesPrimary', 'action' => 'view', $deathCausesSecondary->death_causes_primary->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($deathCausesSecondary->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
