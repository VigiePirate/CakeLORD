<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LittersContribution $littersContribution
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
                ['action' => 'delete', $littersContribution->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $littersContribution->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Litters Contributions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="littersContributions form content">
            <?= $this->Form->create($littersContribution) ?>
            <fieldset>
                <legend><?= __('Edit Litters Contribution') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('priority');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
