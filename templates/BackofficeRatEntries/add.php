<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatEntry $backofficeRatEntry
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Backoffice Rat Entries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="backofficeRatEntries form content">
            <?= $this->Form->create($backofficeRatEntry) ?>
            <fieldset>
                <legend><?= __('Add Backoffice Rat Entry') ?></legend>
                <?php
                    echo $this->Form->control('rat_id', ['options' => $rats, 'empty' => true]);
                    echo $this->Form->control('owner_name');
                    echo $this->Form->control('pup_name');
                    echo $this->Form->control('sex');
                    echo $this->Form->control('pedigree_identifier');
                    echo $this->Form->control('birth_date', ['empty' => true]);
                    echo $this->Form->control('death_date', ['empty' => true]);
                    echo $this->Form->control('primary_death_cause_id');
                    echo $this->Form->control('secondary_death_cause_id');
                    echo $this->Form->control('death_euthanized');
                    echo $this->Form->control('death_diagnosed');
                    echo $this->Form->control('death_necropsied');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('picture_thumbnail');
                    echo $this->Form->control('comments');
                    echo $this->Form->control('validated');
                    echo $this->Form->control('mother_rattery_id');
                    echo $this->Form->control('father_rattery_id');
                    echo $this->Form->control('mother_rat_id');
                    echo $this->Form->control('father_rat_id');
                    echo $this->Form->control('owner_user_id');
                    echo $this->Form->control('color_id', ['options' => $colors, 'empty' => true]);
                    echo $this->Form->control('earset_id', ['options' => $earsets, 'empty' => true]);
                    echo $this->Form->control('eyecolor_id', ['options' => $eyecolors, 'empty' => true]);
                    echo $this->Form->control('dilution_id', ['options' => $dilutions, 'empty' => true]);
                    echo $this->Form->control('coat_id', ['options' => $coats, 'empty' => true]);
                    echo $this->Form->control('marking_id', ['options' => $markings, 'empty' => true]);
                    echo $this->Form->control('creator_user_id');
                    echo $this->Form->control('state_id', ['options' => $states]);
                    echo $this->Form->control('singularities._ids', ['options' => $singularities]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
