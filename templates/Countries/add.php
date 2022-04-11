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
                        'alt' => __('All countries')]) ?>
                    <span class="tooltiptext"><?= __('See all countries') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="countries form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Countries') ?></div>
            </div>
            <h1><?= __('Add Country') ?></h1>
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
