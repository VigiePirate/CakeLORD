<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause $deathSecondaryCause
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'DeathSecondaryCauses',
                'object' => $deathSecondaryCause,
                'tooltip' => __('Browse death category list'),
                'can_cancel' => true,
                'show_staff' => true,
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="deathSecondaryCauses form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Death Causes') ?></div>
            </div>
            <h1><?= __('Edit Death Cause') ?></h1>
            <?= $this->Form->create($deathSecondaryCause) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('death_primary_cause_id', ['options' => $deathPrimaryCauses, 'label' => __('Death category')]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_tumor', ['label' => __('Tumoral cause?')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
