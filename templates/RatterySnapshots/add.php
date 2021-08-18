<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatterySnapshot $ratterySnapshot
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-report.svg', [
          'url' => ['controller' => 'Conversations', 'action' => 'add'],
          'class' => 'side-nav-icon',
          'alt' => __('Report')]) ?>
      <?= $this->Html->image('/img/icon-help.svg', [
              'url' => ['controller' => 'Articles', 'action' => 'index'],
              'class' => 'side-nav-icon',
              'alt' => __('Help')]) ?>
            <?= $this->Html->link(__('List Rattery Snapshots'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratterySnapshots form content">
            <?= $this->Form->create($ratterySnapshot) ?>
            <fieldset>
                <legend><?= __('Add Rattery Snapshot') ?></legend>
                <?php
                    echo $this->Form->control('data');
                    echo $this->Form->control('rattery_id', ['options' => $ratteries]);
                    echo $this->Form->control('state_id', ['options' => $states]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
