<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause $deathSecondaryCause
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Death Secondary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deathSecondaryCauses form content">
            <?= $this->Form->create($deathSecondaryCause) ?>
            <fieldset>
                <legend><?= __('Add Death Secondary Cause') ?></legend>
                <?php
                    echo $this->Form->control('name_fr');
                    echo $this->Form->control('name_en');
                    echo $this->Form->control('death_primary_cause_id', ['options' => $deathPrimaryCauses]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
