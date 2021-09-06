<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContributionType $contributionType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contributionType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contributionType->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Contribution Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contributionTypes form content">
            <?= $this->Form->create($contributionType) ?>
            <fieldset>
                <legend><?= __('Edit Contribution Type') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('priority');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
