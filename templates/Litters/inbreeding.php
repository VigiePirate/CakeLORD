<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
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
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Inbreeding report') ?></div>
                <div class="sheet-markers">
                    <div class="statemark statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></div>
                </div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <h2>Summary</h2>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Shortest family tree branch') ?></th>
                    <td><?= h($coefficients['min_depth'])?>  <?= $coefficients['min_depth'] > 1 ? __('generations') : __('generation') ?></td>
                </tr>

                <tr>
                    <th><?= __('Longest family tree branch') ?></th>
                    <td><?= h($coefficients['max_depth'])?>  <?= $coefficients['max_depth'] > 1 ? __('generations') : __('generation') ?></td>
                </tr>

                <tr>
                    <th><?= __('Number of known ancestors') ?></th>
                    <td><?= h($coefficients['ancestor_number'])?>  <?= $coefficients['ancestor_number'] > 1 ? __('rats') : __('rat') ?></td>
                </tr>

                <tr>
                    <th><?= __('Number of distinct ancestors') ?></th>
                    <td><?= h($coefficients['distinct_number'])?>  <?= $coefficients['distinct_number'] > 1 ? __('rats') : __('rat') ?></td>
                </tr>

                <!-- Common ancestor number could come here -->

                <tr>
                    <th><?= __('Number of founding ancestors') ?></th>
                    <td><?= h($coefficients['founder_number'])?>  <?= ($coefficients['founder_number'] > 1 ? __('rats') : __('rat')) ?></td>
                </tr>

                <tr>
                    <th><?= __('Ancestor Loss Coefficient') ?></th>
                    <td>AVK ≃  <?= h($coefficients['avk']) ?> %</td>
                </tr>

                <tr>
                    <th><?= __('Coefficient of Inbreeding') ?></th>
                    <td>COI  ≃  <?= h($coefficients['coi']) ?> %</td>
                </tr>

            </table>

            <h2>Coancestry analysis</h2>

            <table class="condensed stats histogram">

                <th>
                    <div style="opacity:1; width:100%">
                        <?= h($coefficients['coi']) ?> %
                    </div>
                </th>
                <td>
                    <strong><?= __('Global inbreeding coefficient') ?></strong>
                </td>

                <?php foreach($coefficients['coancestry'] as $ancestor => $contrib) : ?>
                    <tr>
                        <th>
                            <div style="opacity:<?= h(0.25+0.75*$contrib/$coefficients['coi']) ?>; width:<?= h(round(100*log(1+$contrib/$coefficients['coi'],2))) ?>%;">
                                <?= h($contrib) ?> %
                            </div>
                        </th>
                        <td>
                            <?= __('Ancestor id') . ':' . h($ancestor) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <div class="signature">
                &mdash; Estimations are given “as is”.
            </div>
        </div>
    </div>
</div>
