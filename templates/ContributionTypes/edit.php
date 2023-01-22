<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContributionType $contributionType
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'ContributionTypes',
                'object' => $contributionType,
                'tooltip' => __('Browse contribution type list'),
                'show_staff' => true,
                'can_cancel' => true
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="contributionTypes form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Contribution Types') ?></div>
            </div>
            <h1><?= __('Edit Contribution Type') ?></h1>
            <?= $this->Form->create($contributionType) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('priority');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
