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
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Countries', 'action' => 'view', $country->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back') ?></span>
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
        <div class="countries form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Countries') ?></div>
            </div>
            <h1><?= __('Edit') . ' ' . h($country->name) ?></h1>
            <?= $this->Form->create($country) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('iso3166');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
