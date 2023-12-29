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

            <h2><?= __('Summary') ?></h2>

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
                    <td><?= $coefficients['approx'] ? '⩾ ' : '' ?><?= __('{0, plural, =0{None} =1{1 rat} other{# rats}}', [$coefficients['ancestor_number']]) ?></td>
                </tr>

                <tr>
                    <th><?= __('Number of distinct ancestors') ?></th>
                    <td><?= $coefficients['approx'] ? '⩾ ' : '' ?><?= __('{0, plural, =0{None} =1{1 rat} other{# rats}}', [$coefficients['distinct_number']]) ?> </td>
                </tr>

                <tr>
                    <th><?= __('Number of founding ancestors') ?></th>
                    <td><?= $coefficients['approx'] ? '⩾ ' : '' ?><?= __('{0, plural, =0{None} =1{1 rat} other{# rats}}', [$coefficients['founder_number']]) ?> </td>
                </tr>

                <tr>
                    <th><?= __('Number of common ancestors') ?></th>
                    <td><?= $coefficients['approx'] ? '⩾ ' : '' ?> <?= __('{0, plural, =0{None} =1{1 rat} other{# rats}}', [$coefficients['common_number']]) ?> </td>
                </tr>

                <tr>
                    <th><?= __('Ancestor loss coefficient (5G)') ?></th>
                    <td>AVK<sub>5</sub> <?= $coefficients['approx'] ? '≃' : '=' ?>  <?= $this->Number->format($coefficients['avk5']) ?> %</td>
                </tr>

                <tr>
                    <th><?= __('Coefficient of Inbreeding (5G)') ?></th>
                    <td>COI<sub>5</sub> <?= $coefficients['approx'] ? '≃' : '=' ?>  <?= $this->Number->format(round($coefficients['coi5'],2)) ?> %</td>
                </tr>

                <tr>
                    <th><?= __('Coefficient of Inbreeding (16G)') ?></th>
                    <td>COI<sub>16</sub> <?= $coefficients['approx'] ? '≃' : '=' ?>  <?= $this->Number->format(round($coefficients['coi16'],2)) ?> %</td>
                </tr>

            </table>

            <?php if ($coefficients['coi16'] != 0) : ?>

                <h2><?= __('Coancestry analysis') ?></h2>

                <table class="condensed stats histogram">

                    <th>
                        <div style="opacity:1; width:100%">
                            <?= round($coefficients['coi'],2) != 0 ? $this->Number->format(round($coefficients['coi'],2)) : '< ' . $this->Number->format(0.01) ?> %
                        </div>
                    </th>
                    <td>
                        <strong> = <?= __('Global inbreeding coefficient') ?></strong>
                    </td>

                    <?php foreach($coefficients['coancestry'] as $ancestor => $contrib) : ?>
                        <tr>
                            <td class="th">
                                <div style="opacity:<?= h(0.25+0.75*log(1+$contrib['coi']/$coefficients['coi'],2)) ?>; width:<?= h(round(15+100*log(1+$contrib['coi']/$coefficients['coi'],2))) ?>%;">
                                    <?= round($contrib['coi'],2) != 0 ? $this->Number->format(round($contrib['coi'],2)) : '< ' . $this->Number->format(0.01) ?> %
                                </div>
                            </td>
                            <td>
                                 + <?= $this->Html->link(
                                     $contrib['name'],
                                     ['controller' => 'Rats', 'action' => 'view', $ancestor]) ?> (<?= $contrib['count'] ?>)

                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->Html->css('loading'); ?>
