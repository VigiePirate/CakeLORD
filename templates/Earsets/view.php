<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earset $earset
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('Edit Earset'), ['action' => 'edit', $earset->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Earset'), ['action' => 'delete', $earset->id], ['confirm' => __('Are you sure you want to delete # {0}?', $earset->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Earsets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Earset'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="earsets view content">
            <div class="row">
            <?php if ($earset->picture != '') : ?> <!-- should become unnecessary: we should have pictures for all varieties -->
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Earset') ?></div>
                    </div>
                    <h1><?= h($earset->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('earset') ?></div>
                    </div>
                    <h1><?= h($earset->name) ?></h1>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($earset->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($earset->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mandatory picture?') ?></th>
                            <td><?= $earset->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Frequency') ?></th>
                            <td><?= h($frequency) . __(' %') ?> (<?= h($count) ?> rats) </td>
                        </tr>
                    </table>
                </div>
                <?php if ($earset->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $earset->picture, ['alt' => $earset->name]) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="text">
                <h2><?= __('Description') ?></h2>
                <div class="markdown">
                    <?= $this->Commonmark->sanitize($earset->description); ?>
                </div>
            </div>
        </div>
    </div>
</div>
