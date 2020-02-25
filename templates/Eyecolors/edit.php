<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eyecolor $eyecolor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $eyecolor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $eyecolor->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Eyecolors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="eyecolors form content">
            <?= $this->Form->create($eyecolor) ?>
            <fieldset>
                <legend><?= __('Edit Eyecolor') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('genotype');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_picture_mandatory');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
