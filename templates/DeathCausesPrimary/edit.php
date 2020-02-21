<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathCausesPrimary $deathCausesPrimary
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deathCausesPrimary->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deathCausesPrimary->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Death Causes Primary'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deathCausesPrimary form content">
            <?= $this->Form->create($deathCausesPrimary) ?>
            <fieldset>
                <legend><?= __('Edit Death Causes Primary') ?></legend>
                <?php
                    echo $this->Form->control('name_fr');
                    echo $this->Form->control('name_en');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
