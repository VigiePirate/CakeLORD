<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Colors',
                'object' => $color,
                'tooltip' => __('Browse color list'),
                'show_staff' => true
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="colors form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Colors') ?></div>
            </div>
            <h1><?= __('Edit Color') ?></h1>
            <?= $this->Form->create($color) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('genotype');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_picture_mandatory');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
