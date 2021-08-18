<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <div class="spacer"> </div>
            <?= $this->Html->image('/img/icon-labo.svg', [
                'url' => 'http://laborats.weebly.com/' . h($color->name) . '.html',
                'class' => 'side-nav-icon',
                'alt' => __('Laborats')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->link(__('Edit Color'), ['action' => 'edit', $color->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Color'), ['action' => 'delete', $color->id], ['confirm' => __('Are you sure you want to delete # {0}?', $color->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Colors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Color'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
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
                            <th><?= __('Is Picture Mandatory') ?></th>
                            <td><?= $color->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                    <div class="text">
                        <strong><?= __('Description') ?></strong>
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
                <h2><?= __('Gallery') ?></h2>
                <?php if (!empty($color->rats)) : ?>
                    <section id="gallery">
                    <?php foreach ($color->rats as $rat) : ?>
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
