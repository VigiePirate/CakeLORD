<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery $rattery
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
                        'url' => ['controller' => 'Ratteries', 'action' => 'view', $rattery->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to rattery sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Change Picture of ') ?></div>
                <div class="tooltip-state">
                    <div class="current-statemark statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></div>
                    <span class="tooltiptext-state hide-on-mobile"><?= h($rattery->state->name) ?></span>
                </div>
            </div>

            <h1><?= h($rattery->full_name) . '<span class="rotate"> ' . h($rattery->is_inactive_symbol) . '</span>'?></h1>

            <?php
            echo $this->Form->create($rattery, ['type' => 'file']); ?>
            <fieldset>
                <div class="message default">
                    <?= __('Pictures must be in jpeg, gif or png format.') ?> <?= (' They will be resized to a maximum of 900 pixels wide and 600 pixels high.') ?>
                </div>
                <?= $this->Form->control('picture_file', ['type' => 'file']) ?>
            </fieldset>
            <?= $this->Form->button(__('Upload picture')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>