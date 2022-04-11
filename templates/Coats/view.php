<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\coat $coat
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Coats',
                'object' => $coat,
                'tooltip' => __('Browse coat list'),
                'show_staff' => true,
                'is_labo' => true
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="coats view content">
            <div class="row">
            <!-- should become unnecessary: we should have pictures for all varieties -->
            <?php if ($coat->picture != '') : ?>
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
                            <th><?= __('Color name') ?></th>
                            <td><?= h($coat->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($coat->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mandatory picture?') ?></th>
                            <td><?= $coat->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Frequency') ?></th>
                            <td><?= h($frequency) . __(' %') ?> (<?= h($count) ?> rats) </td>
                        </tr>
                    </table>
                </div>
                <?php if ($coat->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $coat->picture, ['alt' => $coat->name]) ?>
                    </div>
                <?php endif ?>
            </div>

            <h2><?= __('Description') ?></h2>
            <div class="markdown"><?= $this->Commonmark->parse($coat->description); ?></div>

            <?php if (!empty($examples)) : ?>
                <div class="related">
                    <h2><?= __('Random gallery') ?></h2>
                    <section id="gallery">
                    <?php foreach ($examples as $rat) : ?>
                        <?php if ($rat->picture != '' && $rat->picture != 'Unknown.png') : ?>
                            <?= $this->Html->image('uploads/' . $rat->picture, ['alt' => $rat->name, 'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id]]) ?>
                        <?php endif ?>
                    <?php endforeach; ?>
                    </section>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
