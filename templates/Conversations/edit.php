<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conversation $conversation
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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $conversation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $conversation->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="conversations form content">
            <?= $this->Form->create($conversation) ?>
            <fieldset>
                <legend><?= __('Edit Conversation') ?></legend>
                <?php
                    echo $this->Form->control('rat_id', ['options' => $rats, 'empty' => true]);
                    echo $this->Form->control('rattery_id', ['options' => $ratteries, 'empty' => true]);
                    echo $this->Form->control('litter_id', ['options' => $litters, 'empty' => true]);
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('users._ids', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
