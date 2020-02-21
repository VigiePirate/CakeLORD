<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Colors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="colors form content">
            <?= $this->Form->create($color) ?>
            <fieldset>
                <legend><?= __('Add Color') ?></legend>
                <?php
                    echo $this->Form->control('name_fr');
                    echo $this->Form->control('genotype');
                    echo $this->Form->control('name_en');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('eyecolor_id', ['options' => $eyecolors, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
