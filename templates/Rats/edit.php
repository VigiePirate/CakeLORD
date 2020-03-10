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
                    echo $this->Form->control('pedigree_identifier');
                    echo $this->Form->control('is_pedigree_custom');
                    echo $this->Form->control('owner_user_id', ['options' => $ownerUsers]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('pup_name');
                    echo $this->Form->control('sex');
                    echo $this->Form->control('birth_date');
                    echo $this->Form->control('rattery_id', ['options' => $ratteries]);
                    echo $this->Form->control('litter_id', ['options' => $birthLitters, 'empty' => true]);
                    echo $this->Form->control('color_id', ['options' => $colors]);
                    echo $this->Form->control('eyecolor_id', ['options' => $eyecolors]);
                    echo $this->Form->control('dilution_id', ['options' => $dilutions]);
                    echo $this->Form->control('marking_id', ['options' => $markings]);
                    echo $this->Form->control('earset_id', ['options' => $earsets]);
                    echo $this->Form->control('coat_id', ['options' => $coats]);
                    echo $this->Form->control('is_alive');
                    echo $this->Form->control('death_date', ['empty' => true]);
                    echo $this->Form->control('death_primary_cause_id', ['options' => $deathPrimaryCauses, 'empty' => true]);
                    echo $this->Form->control('death_secondary_cause_id', ['options' => $deathSecondaryCauses, 'empty' => true]);
                    echo $this->Form->control('death_euthanized');
                    echo $this->Form->control('death_diagnosed');
                    echo $this->Form->control('death_necropsied');
                    echo $this->Form->control('comments');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('picture_thumbnail');
                    echo $this->Form->control('creator_user_id', ['options' => $creatorUsers]);
                    echo $this->Form->control('state_id', ['options' => $states]);
                    echo $this->Form->control('bred_litters._ids', ['options' => $bredLitters]);
                    echo $this->Form->control('singularities._ids', ['options' => $singularities]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
