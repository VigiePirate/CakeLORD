<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathPrimaryCause $deathPrimaryCause
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deathPrimaryCause->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deathPrimaryCause->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Death Primary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deathPrimaryCauses form content">
            <?= $this->Form->create($deathPrimaryCause) ?>
            <fieldset>
                <legend><?= __('Edit Death Primary Cause') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_infant');
                    echo $this->Form->control('is_accident');
                    echo $this->Form->control('is_oldster');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
