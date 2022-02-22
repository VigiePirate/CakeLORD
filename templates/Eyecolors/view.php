<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eyecolor $eyecolor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('Edit eyecolor'), ['action' => 'edit', $eyecolor->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete eyecolor'), ['action' => 'delete', $eyecolor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eyecolor->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List eyecolors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New eyecolor'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="eyecolors view content">
            <div class="row">
            <?php if ($eyecolor->picture != '') : ?> <!-- should become unnecessary: we should have pictures for all varieties -->
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Eyecolor') ?></div>
                    </div>
                    <h1><?= h($eyecolor->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('eyecolor') ?></div>
                    </div>
                    <h1><?= h($eyecolor->name) ?></h1>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($eyecolor->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($eyecolor->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mandatory picture?') ?></th>
                            <td><?= $eyecolor->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Frequency') ?></th>
                            <td><?= h($frequency) . __(' %') ?> (<?= h($count) ?> rats) </td>
                        </tr>
                    </table>
                </div>
                <?php if ($eyecolor->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $eyecolor->picture, ['alt' => $eyecolor->name]) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <div class="markdown">
                    <?= $this->Commonmark->sanitize($earset->description); ?>
                </div>
            </div>
        </div>
    </div>
</div>
