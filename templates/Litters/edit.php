<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $litter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $litter->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Litters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
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
                    echo $this->Form->control('mother_rat_id');
                    echo $this->Form->control('father_rat_id');
                    echo $this->Form->control('creator_user_id', ['options' => $users]);
                    echo $this->Form->control('state_id', ['options' => $states]);
                    echo $this->Form->control('rattery_id', ['options' => $ratteries]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
