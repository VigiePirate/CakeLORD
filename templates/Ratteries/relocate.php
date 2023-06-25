<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->assign('title', h($rattery->full_name)) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Ratteries', 'action' => 'view', $rattery->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back to rattery sheet')]) ?>
                        <span class="tooltiptext"><?= __('Back to rattery sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Record New Location of ') ?></div>
            </div>

            <h1><?= $rattery->full_name ?></h1>

            <?= $this->Flash->render(); ?>

            <?php
            echo $this->Form->create($rattery, [
            	'id' => 'jquery-relocate-form',
            ]); ?>

            <fieldset>
                <legend><?= __('Mandatory information') ?></legend>
                <?php
                    echo $this->Form->control('country_id', [
                        'id' => 'countries',
                        'label' => __('Choose your country'),
                        'options' => $countries,
                        'empty' => false,
                        'required' => true
                    ]);
                ?>
                <legend><?= __('Optional information') ?></legend>
                <?php
                    echo $this->Form->control('district', ['label' => __('Localization (region, district, city...)' )]);
                    echo $this->Form->control('zip_code', ['label' => __('Zipcode (will be used in rattery map)')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Record new location')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
