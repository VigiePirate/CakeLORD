<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Incompatibility $incompatibility
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Incompatibilities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="incompatibilities form content">
            <?= $this->Form->create($incompatibility) ?>
            <fieldset>
                <legend><?= __('Add Incompatibility') ?></legend>
                <?php
                    echo $this->Form->control('genotype1');
                    echo $this->Form->control('genotype2');
                    echo $this->Form->control('comments');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
