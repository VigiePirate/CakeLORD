<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country $country
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
                        'url' => ['controller' => 'Countries', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('Country list')]) ?>
                    <span class="tooltiptext"><?= __('Browse country list') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Countries',
                    'object' => $country
                    ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="countries view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Countries') ?></div>
            </div>
            <h1><?= h($country->name) ?></h1>
            <h2><?= __('Reference information') ?></h2>
            <table class="condensed">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($country->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Iso3166') ?></th>
                    <td><?= h($country->iso3166) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($country->name) ?></td>
                </tr>

            </table>
            <div class="related">
                <h2><?= __('Active ratteries registered in this country') ?></h2>
                <?php if (!empty($country->ratteries)) : ?>
                    <?= $this->element('simple_ratteries', [
                        'rubric' => __(''),
                        'ratteries' => $country->ratteries,
                        'exceptions' => [
                            'picture',
                            'country',
                            'actions'
                        ],
                    ]) ?>
                <?php else : ?>
                    <div class="message"><?= __('There is currently no active rattery registered in this country.') ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
