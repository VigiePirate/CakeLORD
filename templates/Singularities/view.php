<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Singularity $singularity
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <div class="spacer"> </div>
            <?= $this->Html->image('/img/icon-labo.svg', [
                'url' => 'http://laborats.weebly.com/' . h($singularity->name) . '.html',
                'class' => 'side-nav-icon',
                'alt' => __('Laborats')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->link(__('Edit singularity'), ['action' => 'edit', $singularity->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete singularities'), ['action' => 'delete', $singularity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $singularity->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List singularities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New singularity'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="singularities view content">

            <div class="row">
            <?php if ($singularity->picture != '') : ?> <!-- should become unnecessary: we should have pictures for all varieties -->
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Singularity') ?></div>
                    </div>
                    <h1><?= h($singularity->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Singularity') ?></div>
                    </div>
                    <h1><?= h($singularity->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($singularity->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($singularity->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Is Picture Mandatory') ?></th>
                            <td><?= $singularity->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                    <div class="text">
                        <strong><?= __('Description') ?></strong>
                        <div class="markdown">
                            <?= $this->Commonmark->sanitize($singularity->description); ?>
                        </div>
                    </div>
                </div>
                <?php if ($singularity->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $singularity->picture, ['alt' => $singularity->name]) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="related">
                <h2><?= __('Gallery') ?></h2>
                <?php if (!empty($singularity->rats)) : ?>
                    <section id="gallery">
                    <?php foreach ($singularity->rats as $rat) : ?>
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
