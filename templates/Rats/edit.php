<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rat->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rat->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Rats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="rats form content">
            <?= $this->Form->create($rat) ?>
            <fieldset>
                <legend><?= __('Edit Rat') ?></legend>
                <?php
                    echo $this->Form->control('name_owner');
                    echo $this->Form->control('name_pup');
                    echo $this->Form->control('sex');
                    echo $this->Form->control('pedigree_identifier');
                    echo $this->Form->control('date_birth', ['empty' => true]);
                    echo $this->Form->control('date_death', ['empty' => true]);
                    echo $this->Form->control('death_cause_primary_id', ['options' => $deathCausesPrimary, 'empty' => true]);
                    echo $this->Form->control('death_cause_secondary_id', ['options' => $deathCausesSecondary, 'empty' => true]);
                    echo $this->Form->control('death_euthanized');
                    echo $this->Form->control('death_diagnosed');
                    echo $this->Form->control('death_necropsied');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('picture_thumbnail');
                    echo $this->Form->control('comments');
                    echo $this->Form->control('validated');
                    echo $this->Form->control('rattery_mother_id');
                    echo $this->Form->control('rattery_father_id', ['options' => $ratteries, 'empty' => true]);
                    echo $this->Form->control('mother_id');
                    echo $this->Form->control('father_id', ['options' => $rats, 'empty' => true]);
                    echo $this->Form->control('litter_id', ['options' => $litters, 'empty' => true]);
                    echo $this->Form->control('owner_id');
                    echo $this->Form->control('color_id', ['options' => $colors, 'empty' => true]);
                    echo $this->Form->control('earset_id', ['options' => $earsets, 'empty' => true]);
                    echo $this->Form->control('eyecolor_id', ['options' => $eyecolors, 'empty' => true]);
                    echo $this->Form->control('dilution_id', ['options' => $dilutions, 'empty' => true]);
                    echo $this->Form->control('coat_id', ['options' => $coats, 'empty' => true]);
                    echo $this->Form->control('marking_id', ['options' => $markings, 'empty' => true]);
                    echo $this->Form->control('user_creator_id', ['options' => $users]);
                    echo $this->Form->control('singularities._ids', ['options' => $singularities]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
