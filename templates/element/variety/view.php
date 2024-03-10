<?php $this->assign('title', __($Variety) . ' - ' . h($variety->name)) ?>

<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => $Varieties,
                'object' => $variety,
                'tooltip' => $tooltip,
                'help_url' =>  ['controller' => 'Articles', 'action' => 'view', 19],
                'show_staff' => $show_staff,
                'user' => $user,
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
                        <div class="sheet-title pretitle"><?= __($Variety) ?></div>
                    </div>
                    <h1><?= h($variety->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats unfold">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __($Variety) ?></div>
                    </div>
                    <h1><?= h($variety->name) ?></h1>
                    <table class="condensed stats unfold">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($variety->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= $variety->genotype ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mandatory picture?') ?></th>
                            <td><?= $variety->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Frequency (all time)') ?></th>
                            <td><?= __('{0, number} % ({1, plural, =0{no rat} =1{1 rat} other{# rats}})',  [$frequency, $count]) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Frequency (in the last 2 years)') ?></th>
                            <td><?= __('{0, number} % ({1, plural, =0{no rat} =1{1 rat} other{# rats}})',  [$recent_frequency, $recent_count]) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Average lifespan (all causes included)') ?></th>
                            <td><?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$age['all'], $age['female'], $age['male']]) ?></td>
                        </tr>
                    </table>
                </div>
                <?php if ($variety->picture != '') : ?>
                    <div class="column footer-center hide-on-mobile">
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
                        <?= $this->Html->image(UPLOADS . $rat->picture, ['alt' => $rat->name, 'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id]]) ?>
                    <?php endforeach; ?>
                    </section>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
