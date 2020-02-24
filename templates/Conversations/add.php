<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $conversation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="conversations form content">
            <?= $this->Form->create($conversation) ?>
            <fieldset>
                <legend><?= __('Add Conversation') ?></legend>
                <?php
                    echo $this->Form->control('rattery_id');
                    echo $this->Form->control('litter_id');
                    echo $this->Form->control('rat_id');
                    echo $this->Form->control('is_active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
