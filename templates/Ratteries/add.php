<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery $rattery
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
            <?= $this->Html->link(__('List Ratteries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries form content">
            <?= $this->Form->create($rattery) ?>
            <fieldset>
                <legend><?= __('Add Rattery') ?></legend>
                <?php
                    echo $this->Form->control('prefix');
                    echo $this->Form->control('name');
                    echo $this->Form->control('owner_user_id', ['options' => $users]);
                    echo $this->Form->control('birth_year');
                    echo $this->Form->control('is_alive');
                    echo $this->Form->control('is_generic');
                    echo $this->Form->control('district');
                    echo $this->Form->control('zip_code');
                    echo $this->Form->control('country_id', ['options' => $countries]);
                    echo $this->Form->control('website');
                    echo $this->Form->control('comments');
                    echo $this->Form->control('wants_statistic');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('state_id', ['options' => $states]);
                    echo $this->Form->control('litters._ids', ['options' => $litters]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
