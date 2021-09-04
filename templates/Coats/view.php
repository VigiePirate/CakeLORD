<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\coat $coat
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
                        'url' => ['controller' => 'Coats', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All coats')]) ?>
                    <span class="tooltiptext"><?= __('See all coats') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-labo.svg', [
                        'url' => 'http://laborats.weebly.com/' . h($coat->name) . '.html',
                        'class' => 'side-nav-icon',
                        'alt' => __('Laborats')]) ?>
                    <span class="tooltiptext"><?= __('See matching Lab-o-rats entry') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Coats',
                    'object' => $coat
                    ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="coats view content">

            <div class="row">
            <?php if ($coat->picture != '') : ?> <!-- should become unnecessary: we should have pictures for all varieties -->
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Coat') ?></div>
                    </div>
                    <h1><?= h($coat->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Coat') ?></div>
                    </div>
                    <h1><?= h($coat->name) ?></h1>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($coat->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($coat->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Is Picture Mandatory') ?></th>
                            <td><?= $coat->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                </div>
                <?php if ($coat->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $coat->picture, ['alt' => $coat->name]) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($coat->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h2><?= __('Gallery') ?></h2>
                <?php if (!empty($coat->rats)) : ?>
                    <section id="gallery">
                    <?php foreach ($coat->rats as $rat) : ?>
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
