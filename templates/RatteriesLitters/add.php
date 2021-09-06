<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatteriesLitter $ratteriesLitter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('List Ratteries Litters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteriesLitters form content">
            <?= $this->Form->create($ratteriesLitter) ?>
            <fieldset>
                <legend><?= __('Add Ratteries Litter') ?></legend>
                <?php
                    echo $this->Form->control('litters_contribution_id', ['options' => $littersContributions]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
