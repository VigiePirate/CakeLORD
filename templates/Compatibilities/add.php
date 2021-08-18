<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compatibility $compatibility
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('List Compatibilities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="compatibilities form content">
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
