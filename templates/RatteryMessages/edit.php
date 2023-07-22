<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatteryMessage $ratteryMessage
 * @var string[]|\Cake\Collection\CollectionInterface $ratteries
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ratteryMessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ratteryMessage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Rattery Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratteryMessages form content">
            <?= $this->Form->create($ratteryMessage) ?>
            <fieldset>
                <legend><?= __('Edit Rattery Message') ?></legend>
                <?php
                    echo $this->Form->control('rattery_id', ['options' => $ratteries]);
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
