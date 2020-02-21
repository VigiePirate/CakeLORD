<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatMessage $backofficeRatMessage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $backofficeRatMessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatMessage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Backoffice Rat Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="backofficeRatMessages form content">
            <?= $this->Form->create($backofficeRatMessage) ?>
            <fieldset>
                <legend><?= __('Edit Backoffice Rat Message') ?></legend>
                <?php
                    echo $this->Form->control('backoffice_rat_entry_id', ['options' => $backofficeRatEntries]);
                    echo $this->Form->control('staff_id', ['options' => $users, 'empty' => true]);
                    echo $this->Form->control('staff_comments');
                    echo $this->Form->control('owner_comments');
                    echo $this->Form->control('date_staff_comments', ['empty' => true]);
                    echo $this->Form->control('date_owner_comments', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
