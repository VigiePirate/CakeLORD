<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathPrimaryCause $deathPrimaryCause
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'DeathPrimaryCauses',
                'object' => $deathPrimaryCause,
                'tooltip' => __('Browse death category list'),
                'show_staff' => false
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="deathPrimaryCauses form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Death Categories') ?></div>
            </div>
            <h1><?= __('Add Death Category') ?></h1>
            <?= $this->Form->create($deathPrimaryCause) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_infant', ['label' => __('Infant-only?')]);
                    echo $this->Form->control('is_accident', ['label' => __('Accidental?')]);
                    echo $this->Form->control('is_oldster', ['label' => __('Elderly-only?')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
