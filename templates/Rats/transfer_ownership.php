<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-fa-alert.svg', [
                'url' => ['controller' => 'Conversations', 'action' => 'add'],
                'class' => 'side-nav-icon',
                'alt' => __('Report')]) ?>
            <?= $this->Html->image('/img/icon-help.svg', [
                'url' => ['controller' => 'Articles', 'action' => 'index'],
                'class' => 'side-nav-icon',
                'alt' => __('Help')]) ?>
            </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle">Rat Action</div>
            </div>

            <h1><?= __('Transfer Rat Ownership') ?></h1>

            <!-- this message should not be shown to staff members and rat creator) -->
            <div class="message warning">
                Please note that once you confirm transfer, you will not be able to revert it without staff intervention.
            </div>

            <legend><?= __('Please check rat identity') ?></legend>
            <?= $this->element('simple_rats', [
                'rubric' => __(''),
                'rats' =>  ['0' => $rat],
                'exceptions' => [
                    'picture',
                    'age_string',
                    'death_cause',
                ],
            ]) ?>

            <?= $this->Form->create($rat) ?>
            <fieldset>
                <legend><?= __('Select a new owner') ?></legend>
                <?php
                    echo $this->Form->control('owner_user_id', ['options' => $ownerUsers]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Transfer ownership')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
