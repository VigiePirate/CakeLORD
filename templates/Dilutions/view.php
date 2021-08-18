<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\dilution $dilution
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-report.svg', [
                'url' => ['controller' => 'Conversations', 'action' => 'add'],
                'class' => 'side-nav-icon',
                'alt' => __('Report')]) ?>
            <?= $this->Html->image('/img/icon-help.svg', [
                'url' => ['controller' => 'Articles', 'action' => 'index'],
                'class' => 'side-nav-icon',
                'alt' => __('Help')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->image('/img/icon-labo.svg', [
                'url' => 'http://laborats.weebly.com/' . h($dilution->name) . '.html',
                'class' => 'side-nav-icon',
                'alt' => __('Laborats')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->link(__('Edit dilution'), ['action' => 'edit', $dilution->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete dilution'), ['action' => 'delete', $dilution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dilution->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List dilutions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New dilution'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="dilutions view content">

            <div class="row">
            <?php if ($dilution->picture != '') : ?> <!-- should become unnecessary: we should have pictures for all varieties -->
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Dilution') ?></div>
                    </div>
                    <h1><?= h($dilution->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Dilution') ?></div>
                    </div>
                    <h1><?= h($dilution->name) ?></h1>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($dilution->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($dilution->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Is Picture Mandatory') ?></th>
                            <td><?= $dilution->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                </div>
                <?php if ($dilution->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $dilution->picture, ['alt' => $dilution->name]) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($dilution->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h2><?= __('Gallery') ?></h2>
                <?php if (!empty($dilution->rats)) : ?>
                    <section id="gallery">
                    <?php foreach ($dilution->rats as $rat) : ?>
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
