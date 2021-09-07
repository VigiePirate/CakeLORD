<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $litter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $litter->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Litters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <?= $this->Form->create($litter) ?>
            <fieldset>
                <legend><?= __('Edit Litter') ?></legend>
                <?php
                    echo $this->Form->control('mating_date', ['empty' => true]);
                    echo $this->Form->control('birth_date');
                    echo $this->Form->control('pups_number');
                    echo $this->Form->control('pups_number_stillborn');
                    echo $this->Form->control('comments');
                    echo $this->Form->control('creator_user_id', ['options' => $users]);
                    echo $this->Form->control('state_id', ['options' => $states]);
                    echo $this->Form->control('parent_rats._ids', ['options' => $parentRats]);
                    #echo $this->Form->control('ratteries._ids', ['options' => $ratteries]);
                    echo $this->Form->control('contributions._ids', ['options' => $contributions]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
