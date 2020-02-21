<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathCausesSecondary $deathCausesSecondary
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deathCausesSecondary->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deathCausesSecondary->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Death Causes Secondary'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deathCausesSecondary form content">
            <?= $this->Form->create($deathCausesSecondary) ?>
            <fieldset>
                <legend><?= __('Edit Death Causes Secondary') ?></legend>
                <?php
                    echo $this->Form->control('name_fr');
                    echo $this->Form->control('name_en');
                    echo $this->Form->control('deces_principal_id', ['options' => $deathCausesPrimary]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
