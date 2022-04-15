<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
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
                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Manage Litter Contributions of') ?></div>
                <div class="sheet-markers">
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($litter->state->name) ?></span>
                    </div>
                </div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
