<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LitterMessage $litterMessage
 * @var \Cake\Collection\CollectionInterface|string[] $litters
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Litter Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="litterMessages form content">
            <?= $this->Form->create($litterMessage) ?>
            <fieldset>
                <legend><?= __('Add Litter Message') ?></legend>
                <?php
                    echo $this->Form->control('litter_id', ['options' => $litters]);
                    echo $this->Form->control('from_user_id', ['options' => $users]);
                    echo $this->Form->control('content');
                    echo $this->Form->control('is_staff_request');
                    echo $this->Form->control('is_automatically_generated');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
