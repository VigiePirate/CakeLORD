<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatteryMessage $backofficeRatteryMessage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $backofficeRatteryMessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatteryMessage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Backoffice Rattery Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="backofficeRatteryMessages form content">
            <?= $this->Form->create($backofficeRatteryMessage) ?>
            <fieldset>
                <legend><?= __('Edit Backoffice Rattery Message') ?></legend>
                <?php
                    echo $this->Form->control('rattery_id', ['options' => $ratteries]);
                    echo $this->Form->control('staff_id', ['options' => $users, 'empty' => true]);
                    echo $this->Form->control('staff_comments');
                    echo $this->Form->control('owner_comments');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
