<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathPrimaryCause $deathPrimaryCause
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'DeathPrimaryCauses',
                'object' => $deathPrimaryCause,
                'tooltip' => __('Browse death category list'),
                'help_url' =>  ['controller' => 'Articles', 'action' => 'index']
            ])
        ?>
    </aside>

    <div class="column-responsive column-90">
        <div class="deathPrimaryCauses view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Death category') ?></div>
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

            <h2><?= __('Description') ?></h2>
            <div class="markdown">
                <?= $this->Commonmark->parse($deathPrimaryCause->description); ?>
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
