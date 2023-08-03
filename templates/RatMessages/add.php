<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatMessage $ratMessage
 * @var \Cake\Collection\CollectionInterface|string[] $rats
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Rat Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratMessages form content">
            <?= $this->Form->create($ratMessage) ?>
            <fieldset>
                <legend><?= __('Add Rat Message') ?></legend>
                <?php
                    echo $this->Form->control('rat_id', ['options' => $rats]);
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
