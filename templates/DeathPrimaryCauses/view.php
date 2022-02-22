<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathPrimaryCause $deathPrimaryCause
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <div class="spacer"> </div>
            <?= $this->Html->image('/img/icon-search-rats.svg', [
                'url' => ['controller' => 'Rats', 'action' => 'findByPrimaryDeath'],
                'class' => 'side-nav-icon',
                'alt' => __('Help')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->link(__('Edit Death Primary Cause'), ['action' => 'edit', $deathPrimaryCause->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Death Primary Cause'), ['action' => 'delete', $deathPrimaryCause->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathPrimaryCause->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Death Primary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Death Primary Cause'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="deathPrimaryCauses view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Primary Death Cause') ?></div>
            </div>
            <h1><?= h($deathPrimaryCause->name) ?></h1>

            <h2><?= __('Reference information') ?></h2>

            <table class="condensed">
                <tr>
                    <th><?= __('Identification code') ?></th>
                    <td><?= $this->Number->format($deathPrimaryCause->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Happens only to infant rats?') ?></th>
                    <td><?= $deathPrimaryCause->is_infant ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Accidental cause?') ?></th>
                    <td><?= $deathPrimaryCause->is_accident ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Happens only to elderly rats?') ?></th>
                    <td><?= $deathPrimaryCause->is_oldster ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

            <div class="text">
                <strong><?= __('Description') ?></strong>
                <div class="markdown">
                    <?= $this->Commonmark->parse($deathPrimaryCause->description); ?>
                </div>
            </div>

            <h2><?= __('Statistics') ?></h3>
            <table class="condensed">
                <tr>
                    <th><?= __('Frequency') ?></th>
                    <td><?= h($frequency) . __(' %') ?> (<?= h($count) ?> rats) </td>
                </tr>
                <tr>
                    <th><?= __('Sex ratio') ?></th>
                    <td><?= h($sex_ratio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Average age') ?></th>
                    <td><?= h($age) . __(' months') ?></td>
                </tr>
            </table>

            <div class="related">
                <h2><?= __('Related information') ?></h2>
                <h3><?= __('Related Death Secondary Causes') ?></h3>
                <?php if (!empty($deathPrimaryCause->death_secondary_causes)) : ?>
                <div class="table-responsive">
                    <table class="summary">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Tumor?') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($deathPrimaryCause->death_secondary_causes as $deathSecondaryCauses) : ?>
                        <tr>
                            <td><?= h($deathSecondaryCauses->id) ?></td>
                            <td><?= h($deathSecondaryCauses->name) ?></td>
                            <td><?= h($deathSecondaryCauses->is_tumor) ?></td>
                            <td class="actions">
                                <?= $this->Html->image('/img/icon-view.svg', [
                                    'url' => ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $deathSecondaryCauses->id],
                                    'class' => 'action-icon',
                                    'alt' => __('See Rat')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
