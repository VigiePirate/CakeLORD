<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => $Varieties,
                'object' => $variety,
                'tooltip' => $tooltip,
                'show_staff' => $show_staff,
                'is_labo' => true
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="varieties view content">
            <div class="row">
            <!-- should become unnecessary: we should have pictures for all varieties -->
            <?php if ($variety->picture != '') : ?>
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= $Variety ?></div>
                    </div>
                    <h1><?= h($variety->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= $Variety ?></div>
                    </div>
                    <h1><?= h($variety->name) ?></h1>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($variety->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($variety->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mandatory picture?') ?></th>
                            <td><?= $variety->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Frequency') ?></th>
                            <td><?= h($frequency) . __(' %') ?> (<?= h($count) ?> <?= __('rats') ?>)</td>
                        </tr>
                    </table>
                </div>
                <?php if ($variety->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image(UPLOADS . $variety->picture, ['alt' => $variety->name]) ?>
                    </div>
                <?php endif ?>
            </div>

            <h2><?= __('Description') ?></h2>
            <div class="markdown"><?= $this->Commonmark->parse($variety->description); ?></div>

            <?php if (!empty($examples)) : ?>
                <div class="related">
                    <h2><?= __('Random gallery') ?></h2>
                    <section id="gallery">
                    <?php foreach ($examples as $rat) : ?>
                        <?php if ($rat->picture != '' && $rat->picture != 'Unknown.png') : ?>
                            <?= $this->Html->image(UPLOADS . $rat->picture, ['alt' => $rat->name, 'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id]]) ?>
                        <?php endif ?>
                    <?php endforeach; ?>
                    </section>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
