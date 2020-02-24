<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatSnapshot $ratSnapshot
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Rat Snapshots'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratSnapshots form content">
            <?= $this->Form->create($ratSnapshot) ?>
            <fieldset>
                <legend><?= __('Add Rat Snapshot') ?></legend>
                <?php
                    echo $this->Form->control('data');
                    echo $this->Form->control('rat_id', ['options' => $rats]);
                    echo $this->Form->control('state_id', ['options' => $states]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
