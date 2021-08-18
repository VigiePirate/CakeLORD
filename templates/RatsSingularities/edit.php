<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatsSingularity $ratsSingularity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ratsSingularity->rat_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ratsSingularity->rat_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Rats Singularities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratsSingularities form content">
            <?= $this->Form->create($ratsSingularity) ?>
            <fieldset>
                <legend><?= __('Edit Rats Singularity') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
