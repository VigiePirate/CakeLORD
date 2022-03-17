<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Inbreeding report') ?></div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <?= $this->Flash->render() ?>

            <h2>Summary</h2>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Longest family tree branch') ?></th>
                    <td><?= $coefficients['approx'] ? '⩾ ' : '' ?><?= h($coefficients['max_depth'])?>  <?= $coefficients['max_depth'] > 1 ? __('generations') : __('generation') ?></td>
                </tr>

                <tr>
                    <th><?= __('Shortest family tree branch') ?></th>
                    <td><?= h($coefficients['min_depth'])?>  <?= $coefficients['min_depth'] > 1 ? __('generations') : __('generation') ?></td>
                </tr>

                <tr>
                    <th><?= __('Number of known ancestors') ?></th>
                    <td><?= $coefficients['approx'] ? '⩾ ' : '' ?><?= h($coefficients['ancestor_number'])?>  <?= $coefficients['ancestor_number'] > 1 ? __('rats') : __('rat') ?></td>
                </tr>

                <tr>
                    <th><?= __('Number of distinct ancestors') ?></th>
                    <td><?= h($coefficients['distinct_number'])?>  <?= $coefficients['distinct_number'] > 1 ? __('rats') : __('rat') ?></td>
                </tr>

                <tr>
                    <th><?= __('Number of founding ancestors') ?></th>
                    <td><?= h($coefficients['founder_number'])?>  <?= ($coefficients['founder_number'] > 1 ? __('rats') : __('rat')) ?></td>
                </tr>

                <tr>
                    <th><?= __('Number of common ancestors') ?></th>
                    <td><?= $coefficients['approx'] ? '⩾ ' : '' ?><?= h($coefficients['common_number'])?>  <?= $coefficients['common_number'] > 1 ? __('rats') : __('rat') ?></td>
                </tr>

                <tr>
                    <th><?= __('Ancestor loss coefficient (5G)') ?></th>
                    <td>AVK<sub>5</sub> <?= $coefficients['approx'] ? '≃' : '=' ?>  <?= h($coefficients['avk5']) ?> %</td>
                </tr>

                <tr>
                    <th><?= __('Ancestor loss coefficient (10G)') ?></th>
                    <td>AVK<sub>10</sub> <?= $coefficients['approx'] ? '≃' : '=' ?>  <?= h($coefficients['avk10']) ?> %</td>
                </tr>

                <tr>
                    <th><?= __('Coefficient of Inbreeding') ?></th>
                    <td>COI  <?= $coefficients['approx'] ? '≃' : '=' ?>  <?= h(round($coefficients['coi'],2)) ?> %</td>
                </tr>

            </table>

            <?php if ($coefficients['coi'] != 0) : ?>

                <h2>Coancestry analysis</h2>

                <table class="condensed stats histogram">

                    <th>
                        <div style="opacity:1; width:100%">
                            <?= round($coefficients['coi'],2) != 0 ? h(round($coefficients['coi'],2)) : '< 0.01' ?> %
                        </div>
                    </th>
                    <td>
                        <strong> = <?= __('Global inbreeding coefficient') ?></strong>
                    </td>

                    <?php foreach($coefficients['coancestry'] as $ancestor => $contrib) : ?>
                        <tr>
                            <th>
                                <div style="opacity:<?= h(0.25+0.75*$contrib['coi']/$coefficients['coi']) ?>; width:<?= h(round(100*log(1+$contrib['coi']/$coefficients['coi'],2))) ?>%;">
                                    <?= round($contrib['coi'],2) != 0 ? h(round($contrib['coi'],2)) : '< 0.01' ?> %
                                </div>
                            </th>
                            <td>
                                 + <?= $this->Html->link(
                                     $contrib['name'],
                                     ['controller' => 'Rats', 'action' => 'view', $ancestor]) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
