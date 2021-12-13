<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
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
                        'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to rat sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= _('Family report') ?></div>
            </div>

            <h1>
                <!-- to be improved -->
                <?= h($rat->usual_name) . '<span class="sexcolor_' . h($rat->sex) . '"> ' . h($rat->sex_symbol) . '</span><span>' . h($rat->is_alive_symbol) . '</span>' ?>
            </h1>

            <h2><?= __('Family size') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Total number of known ancestors:') ?></th>
                    <td><?= h($ancestors) . __(' rats') ?></td>
                </tr>
                <tr>
                    <th><?= __('Number of alive ancestors:') ?></th>
                    <td><?= h($asc_alive) . __(' rats') ?></td>
                </tr>
            </table>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Number of children:') ?></th>
                    <td><?= h($children) . __(' rats') ?></td>
                </tr>
                <tr>
                    <th><?= __('Total number of descendants:') ?></th>
                    <td><?= h($descendors) . __(' rats') ?></td>
                </tr>
                <tr>
                    <th><?= __('Number of alive descendants:') ?></th>
                    <td><?= h($desc_alive) . __(' rats') ?></td>
                </tr>
            </table>

            <h2><?= __('Family health') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Ancestors average lifespan:') ?></th>
                    <td><?= h($stats['asc_lifespan']) . __(' months') ?> (♀: <?= h($stats['asc_female_lifespan']) ?>, ♂: <?= h($stats['asc_male_lifespan']) ?>)</td>
                </tr>
                <tr>
                    <th> ⨽ infant mortality excluded:</th>
                    <td> ⨽ <?= h($stats['asc_not_infant_lifespan']) . __(' months') ?> (♀: <?= h($stats['asc_female_not_infant_lifespan']) ?>, ♂: <?= h($stats['asc_male_not_infant_lifespan']) ?>)</td>
                </tr>
                <tr>
                    <th> ⨽ accidents excluded:</th>
                    <td> ⨽ <?= h($stats['asc_not_accident_lifespan']) . __(' months') ?> (♀: <?= h($stats['asc_female_not_accident_lifespan']) ?>, ♂: <?= h($stats['asc_male_not_accident_lifespan']) ?>)</td>
                </tr>
            </table>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Descendants average lifespan:') ?></th>
                    <td><?= h($stats['desc_lifespan']) . __(' months') ?> (♀: <?= h($stats['desc_female_lifespan']) ?>, ♂: <?= h($stats['desc_male_lifespan']) ?>)</td>
                </tr>
                <tr>
                    <th> ⨽ infant mortality excluded:</th>
                    <td> ⨽ <?= h($stats['desc_not_infant_lifespan']) . __(' months') ?> (♀: <?= h($stats['desc_female_not_infant_lifespan']) ?>, ♂: <?= h($stats['desc_male_not_infant_lifespan']) ?>)</td>
                </tr>
                <tr>
                    <th> ⨽ accidents excluded:</th>
                    <td> ⨽ <?= h($stats['desc_not_accident_lifespan']) . __(' months') ?> (♀: <?= h($stats['desc_female_not_accident_lifespan']) ?>, ♂: <?= h($stats['desc_male_not_accident_lifespan']) ?>)</td>
                </tr>
            </table>
        </div>
    </div>
</div>
