<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LittersContribution $littersContribution
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Litters Contributions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="littersContributions form content">
            <?= $this->Form->create($littersContribution) ?>
            <fieldset>
                <legend><?= __('Add Litters Contribution') ?></legend>
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
