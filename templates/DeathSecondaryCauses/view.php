<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause $deathSecondaryCause
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('Edit Death Secondary Cause'), ['action' => 'edit', $deathSecondaryCause->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Death Secondary Cause'), ['action' => 'delete', $deathSecondaryCause->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathSecondaryCause->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Death Secondary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Death Secondary Cause'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="deathSecondaryCauses view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Secondary Death Cause') ?></div>
            </div>
            <h1><?= h($deathSecondaryCause->name) ?></h1>

            <h2><?= __('Reference information') ?></h2>

            <table class="condensed">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($deathSecondaryCause->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Primary Cause') ?></th>
                    <td><?= $deathSecondaryCause->has('death_primary_cause') ? $this->Html->link($deathSecondaryCause->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $deathSecondaryCause->death_primary_cause->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Tumor') ?></th>
                    <td><?= $deathSecondaryCause->is_tumor ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($deathSecondaryCause->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h2><?= __('Statistics') ?></h2>

                <h2><?= __('Related rats') ?></h2>
                <?= $this->element('simple_rats', [ //rats
                    'rubric' => __(''),
                    'rats' =>  $deathSecondaryCause->rats,
                    'exceptions' => [
                        'picture',
                        'owner_user_id',
                        'death_primary_cause',
                        'death_secondary_cause',
                        'death_cause',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
