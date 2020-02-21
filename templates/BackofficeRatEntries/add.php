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
                    echo $this->Form->control('status');
                    echo $this->Form->control('rat_id', ['options' => $rats, 'empty' => true]);
                    echo $this->Form->control('rat_name_owner');
                    echo $this->Form->control('rat_name_pup');
                    echo $this->Form->control('rat_sex');
                    echo $this->Form->control('rat_pedigree_identifier');
                    echo $this->Form->control('rat_date_birth', ['empty' => true]);
                    echo $this->Form->control('rat_date_death', ['empty' => true]);
                    echo $this->Form->control('death_cause_primary_id', ['options' => $deathCausesPrimary, 'empty' => true]);
                    echo $this->Form->control('death_cause_secondary_id', ['options' => $deathCausesSecondary, 'empty' => true]);
                    echo $this->Form->control('rat_death_euthanized');
                    echo $this->Form->control('rat_death_diagnosed');
                    echo $this->Form->control('rat_death_necropsied');
                    echo $this->Form->control('rat_picture');
                    echo $this->Form->control('rat_picture_thumbnail');
                    echo $this->Form->control('rat_comments');
                    echo $this->Form->control('rat_validated');
                    echo $this->Form->control('rattery_mother_id');
                    echo $this->Form->control('rattery_father_id', ['options' => $ratteries, 'empty' => true]);
                    echo $this->Form->control('rat_mother_id');
                    echo $this->Form->control('rat_father_id', ['options' => $backofficeRatEntries, 'empty' => true]);
                    echo $this->Form->control('user_owner_id');
                    echo $this->Form->control('color_id', ['options' => $colors, 'empty' => true]);
                    echo $this->Form->control('earset_id', ['options' => $earsets, 'empty' => true]);
                    echo $this->Form->control('eyecolor_id', ['options' => $eyecolors, 'empty' => true]);
                    echo $this->Form->control('dilution_id', ['options' => $dilutions, 'empty' => true]);
                    echo $this->Form->control('coat_id', ['options' => $coats, 'empty' => true]);
                    echo $this->Form->control('marking_id', ['options' => $markings, 'empty' => true]);
                    echo $this->Form->control('singularity_id_list');
                    echo $this->Form->control('user_creator_id', ['options' => $users, 'empty' => true]);
                    echo $this->Form->control('rat_date_create', ['empty' => true]);
                    echo $this->Form->control('rat_date_last_update', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
