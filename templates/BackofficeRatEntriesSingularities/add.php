<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatEntriesSingularity $backofficeRatEntriesSingularity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Backoffice Rat Entries Singularities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="backofficeRatEntriesSingularities form content">
            <?= $this->Form->create($backofficeRatEntriesSingularity) ?>
            <fieldset>
                <legend><?= __('Add Backoffice Rat Entries Singularity') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
