<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->assign('title', __('Family of {0}', [h($rat->usual_name)])) ?>

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
                <div class="sheet-title pretitle"><?= __('Family report') ?></div>
                <div class="tooltip-state">
                    <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                    <span class="tooltiptext-state hide-on-mobile"><?= h($rat->state->name) ?></span>
                </div>
            </div>

            <h1>
                <!-- to be improved -->
                <?= h($rat->usual_name) . '<span class="sexcolor_' . h($rat->sex) . '"> ' . h($rat->sex_symbol) . '</span><span>' . h($rat->is_alive_symbol) . '</span>' ?>
            </h1>

            <h2><?= __('Family size') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Total number of known ancestors:') ?></th>
                    <td><?= __('{0, plural,=0{0 rat} =1{1 rat} other{# rats}}', $stats['ancestors']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Number of alive ancestors:') ?></th>
                    <td><?= __('{0, plural,=0{0 rat} =1{1 rat} other{# rats}}', $stats['asc_alive']) ?></td>
                </tr>
            </table>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Number of children:') ?></th>
                    <td><?= __('{0, plural,=0{0 rat} =1{1 rat} other{# rats}}', $stats['children']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total number of descendants:') ?></th>
                    <td><?= __('{0, plural,=0{0 rat} =1{1 rat} other{# rats}}', $stats['descendors']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Number of alive descendants:') ?></th>
                    <td><?= __('{0, plural,=0{0 rat} =1{1 rat} other{# rats}}', $stats['desc_alive']) ?></td>
                </tr>
            </table>

            <h2><?= __('Family health') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Ancestors average lifespan:') ?></th>
                    <td><?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['asc_lifespan'], $stats['asc_female_lifespan'], $stats['asc_male_lifespan']]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('infant mortality excluded:') ?></th>
                    <td> ⨽ <?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['asc_not_infant_lifespan'], $stats['asc_female_not_infant_lifespan'], $stats['asc_male_not_infant_lifespan']]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('accidents excluded:') ?></th>
                    <td> ⨽ <?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['asc_not_accident_lifespan'], $stats['asc_female_not_accident_lifespan'], $stats['asc_male_not_accident_lifespan']]) ?></td>
                </tr>
            </table>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Descendants average lifespan:') ?></th>
                    <td><?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['desc_lifespan'], $stats['desc_female_lifespan'], $stats['desc_male_lifespan']]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('infant mortality excluded:') ?></th>
                    <td> ⨽ <?= __('{0, number} months (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['desc_not_infant_lifespan'], $stats['desc_female_not_infant_lifespan'], $stats['desc_male_not_infant_lifespan']]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('accidents excluded:') ?></th>
                    <td> ⨽ <?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['desc_not_accident_lifespan'], $stats['desc_female_not_accident_lifespan'], $stats['desc_male_not_accident_lifespan']]) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
