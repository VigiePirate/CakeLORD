<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\marking $marking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <div class="spacer"> </div>
            <?= $this->Html->image('/img/icon-labo.svg', [
                'url' => 'http://laborats.weebly.com/' . h($marking->name) . '.html',
                'class' => 'side-nav-icon',
                'alt' => __('Laborats')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->link(__('Edit marking'), ['action' => 'edit', $marking->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete marking'), ['action' => 'delete', $marking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $marking->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List markings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New marking'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="markings view content">

            <div class="row">
            <?php if ($marking->picture != '') : ?> <!-- should become unnecessary: we should have pictures for all varieties -->
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Marking') ?></div>
                    </div>
                    <h1><?= h($marking->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Marking') ?></div>
                    </div>
                    <h1><?= h($marking->name) ?></h1>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($marking->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($marking->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mandatory picture?') ?></th>
                            <td><?= $marking->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Frequency') ?></th>
                            <td><?= h($frequency) . __(' %') ?> (<?= h($count) ?> rats) </td>
                        </tr>
                    </table>
                </div>
                <?php if ($marking->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $marking->picture, ['alt' => $marking->name]) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="text">
                <h2><?= __('Description') ?></h2>
                <div class="markdown">
                    <?= $this->Commonmark->sanitize($marking->description); ?>
                </div>
            </div>
            <div class="related">
                <h2><?= __('Gallery') ?></h2>
                <?php if (!empty($marking->rats)) : ?>
                    <section id="gallery">
                    <?php foreach ($marking->rats as $rat) : ?>
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
