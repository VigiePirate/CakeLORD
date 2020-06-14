<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause $deathSecondaryCause
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-fa-alert.svg', [
          'url' => ['controller' => 'Conversations', 'action' => 'add'],
          'class' => 'side-nav-icon',
          'alt' => __('Report')]) ?>
      <?= $this->Html->image('/img/icon-help.svg', [
              'url' => ['controller' => 'Articles', 'action' => 'index'],
              'class' => 'side-nav-icon',
              'alt' => __('Help')]) ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deathSecondaryCause->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deathSecondaryCause->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Death Secondary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="deathSecondaryCauses form content">
            <?= $this->Form->create($deathSecondaryCause) ?>
            <fieldset>
                <legend><?= __('Edit Death Secondary Cause') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('death_primary_cause_id', ['options' => $deathPrimaryCauses]);
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
