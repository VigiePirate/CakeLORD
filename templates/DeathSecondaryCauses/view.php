<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause $deathSecondaryCause
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
            <?= $this->Html->link(__('Edit Death Secondary Cause'), ['action' => 'edit', $deathSecondaryCause->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Death Secondary Cause'), ['action' => 'delete', $deathSecondaryCause->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathSecondaryCause->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Death Secondary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Death Secondary Cause'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="deathSecondaryCauses view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Death Secondary Cause') ?></div>
            </div>
            <h1><?= h($deathSecondaryCause->name) ?></h1>
            <h2><? __('Information') ?></h2>
            <table class="condensed">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($deathSecondaryCause->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Primary Cause') ?></th>
                    <td><?= $deathSecondaryCause->has('death_primary_cause') ? $this->Html->link($deathSecondaryCause->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $deathSecondaryCause->death_primary_cause->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($deathSecondaryCause->id) ?></td>
                </tr>
            </table>
            <h2><?= __('Description') ?></h2>
            <div class="text">
                <blockquote>
                    <?= $this->Text->autoParagraph(h($deathSecondaryCause->description)); ?>
                </blockquote>
            </div>
            <div class="spacer"> </div>
            <h2><?= __('Related information') ?></h2>

            <div class="related">
                <h3><?= __('Statistics') ?></h3>
            </div>

            <div class="related">
                <h3><?= __('Related rats') ?></h3>
                <?= $this->element('simple_rats', [ //rats
                    'rubric' => __(''),
                    'rats' =>  $deathSecondaryCause->rats,//$offsprings,
                    'exceptions' => [
                        'picture',
                        'pup_name',
                        'death_primary_cause',
                        'death_secondary_cause',
                        'death_cause',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
