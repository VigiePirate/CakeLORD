<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Singularity $singularity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $singularity->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $singularity->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Singularities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="singularities form content">
            <?= $this->Form->create($singularity) ?>
            <fieldset>
                <legend><?= __('Edit Singularity') ?></legend>
                <?php
                    echo $this->Form->control('name_fr');
                    echo $this->Form->control('name_en');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('backoffice_rat_entries._ids', ['options' => $backofficeRatEntries]);
                    echo $this->Form->control('rats._ids', ['options' => $rats]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
