<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $litterSnapshot
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Litter Snapshots'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="litterSnapshots form content">
            <?= $this->Form->create($litterSnapshot) ?>
            <fieldset>
                <legend><?= __('Add Litter Snapshot') ?></legend>
                <?php
                    echo $this->Form->control('data');
                    echo $this->Form->control('litter_id');
                    echo $this->Form->control('state_id');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
