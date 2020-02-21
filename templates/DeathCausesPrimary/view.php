<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathCausesPrimary $deathCausesPrimary
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Death Causes Primary'), ['action' => 'edit', $deathCausesPrimary->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Death Causes Primary'), ['action' => 'delete', $deathCausesPrimary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathCausesPrimary->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Death Causes Primary'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Death Causes Primary'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deathCausesPrimary view content">
            <h3><?= h($deathCausesPrimary->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name Fr') ?></th>
                    <td><?= h($deathCausesPrimary->name_fr) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name En') ?></th>
                    <td><?= h($deathCausesPrimary->name_en) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($deathCausesPrimary->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
