<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coat $coat
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
                ['action' => 'delete', $coat->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $coat->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Coats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="coats form content">
            <?= $this->Form->create($coat) ?>
            <fieldset>
                <legend><?= __('Edit Coat') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('genotype');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_picture_mandatory');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
