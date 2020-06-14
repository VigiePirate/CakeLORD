<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContributionType $contributionType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Contribution Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contributionTypes form content">
            <?= $this->Form->create($contributionType) ?>
            <fieldset>
                <legend><?= __('Add Contribution Type') ?></legend>
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
