<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coat $coat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <div class="spacer"> </div>
            <?= $this->Html->link(__('List Coats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="coats form content">
            <?= $this->Form->create($coat) ?>
            <fieldset>
                <legend><?= __('Add Coat') ?></legend>
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
