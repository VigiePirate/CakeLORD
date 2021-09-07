<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatsLitter $ratsLitter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ratsLitter->rat_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ratsLitter->rat_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Rats Litters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratsLitters form content">
            <?= $this->Form->create($ratsLitter) ?>
            <fieldset>
                <legend><?= __('Edit Rats Litter') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
