<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log $log
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $log->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $log->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="logs form content">
            <?= $this->Form->create($log) ?>
            <fieldset>
                <legend><?= __('Edit Log') ?></legend>
                <?php
                    echo $this->Form->control('event');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
