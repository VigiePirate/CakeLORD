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
                    echo $this->Form->control('date_mating', ['empty' => true]);
                    echo $this->Form->control('date_birth', ['empty' => true]);
                    echo $this->Form->control('number_pups');
                    echo $this->Form->control('number_pups_stillborn');
                    echo $this->Form->control('comments');
                    echo $this->Form->control('rat_mother_id');
                    echo $this->Form->control('rat_father_id');
                    echo $this->Form->control('owner_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
