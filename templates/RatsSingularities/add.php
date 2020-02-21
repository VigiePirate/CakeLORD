<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatsSingularity $ratsSingularity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Rats Singularities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratsSingularities form content">
            <?= $this->Form->create($ratsSingularity) ?>
            <fieldset>
                <legend><?= __('Add Rats Singularity') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
