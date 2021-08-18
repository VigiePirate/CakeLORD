<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause $deathSecondaryCause
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('List Death Secondary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deathSecondaryCauses form content">
            <?= $this->Form->create($deathSecondaryCause) ?>
            <fieldset>
                <legend><?= __('Add Death Secondary Cause') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('death_primary_cause_id', ['options' => $deathPrimaryCauses]);
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_tumor');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
