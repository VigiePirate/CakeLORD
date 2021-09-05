<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
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
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Colors', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All colors')]) ?>
                    <span class="tooltiptext"><?= __('See all colors') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->link(
                        $this->Html->image('/img/icon-laborats.svg', [
                            'class' => 'side-nav-icon',
                            'alt' => __('Laborats')]),
                        'http://laborats.weebly.com/' . h($color->name) . '.html',
                        ['escape' => false, 'target' => '_blank']
                    ); ?>
                    <span class="tooltiptext"><?= __('See matching Lab-o-rats entry') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Colors',
                    'object' => $color
                    ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="colors view content">

            <div class="row">
            <?php if ($color->picture != '') : ?> <!-- should become unnecessary: we should have pictures for all varieties -->
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Color') ?></div>
                    </div>
                    <h1><?= h($color->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Color') ?></div>
                    </div>
                    <h1><?= h($color->name) ?></h1>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($color->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($color->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mandatory picture?') ?></th>
                            <td><?= $color->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Frequency') ?></th>
                            <td><?= __(' % of all rats have this color') ?></td>
                        </tr>
                    </table>
                    <div class="text">
                        <h2><?= __('Description') ?></h2>
                        <blockquote>
                            <?= $this->Text->autoParagraph(h($color->description)); ?>
                        </blockquote>
                    </div>
                </div>
                <?php if ($color->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $color->picture, ['alt' => $color->name]) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="related">
                <h2><?= __('Random gallery') ?></h2>
                <?php if (!empty($examples)) : ?>
                    <section id="gallery">
                    <?php foreach ($examples as $rat) : ?>
                        <?php if ($rat->picture != '') : ?>
                            <?= $this->Html->image('uploads/' . $rat->picture, ['alt' => $rat->name, 'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id]]) ?>
                        <?php endif ?>
                    <?php endforeach; ?>
                    </section>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
