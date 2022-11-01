<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compatibility $compatibility
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Compatibilities',
                'object' => $compatibility,
                'tooltip' => __('Browse compatibility rules list'),
                'show_staff' => false
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="operators form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Compatibility rules') ?></div>
            </div>
            <h1><?= __('Add Compatibility Rule') ?></h1>
            <?= $this->Form->create($compatibility) ?>
            <fieldset>
                <legend><?= __('Add Compatibility') ?></legend>
                <?php
                    echo $this->Form->control('left_genotype');
                    echo $this->Form->control('operator_id', ['options' => $operators]);
                    echo $this->Form->control('right_genotype');
                    echo $this->Form->control('comments');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
