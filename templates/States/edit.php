<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $state->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $state->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="states form content">
            <?= $this->Form->create($state) ?>
            <fieldset>
                <legend><?= __('Edit State') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('color');
                    echo $this->Form->control('symbol');
                    echo $this->Form->control('css_property');
                    echo $this->Form->control('is_default');
                    echo $this->Form->control('needs_user_action');
                    echo $this->Form->control('needs_staff_action');
                    echo $this->Form->control('is_reliable');
                    echo $this->Form->control('is_visible');
                    echo $this->Form->control('is_searchable');
                    echo $this->Form->control('is_frozen');
                    echo $this->Form->control('next_ok_state_id', ['options' => $nextOkStates, 'empty' => true]);
                    echo $this->Form->control('next_ko_state_id', ['options' => $nextKoStates, 'empty' => true]);
                    echo $this->Form->control('next_frozen_state_id', ['options' => $nextFrozenStates, 'empty' => true]);
                    echo $this->Form->control('next_thawed_state_id', ['options' => $nextThawedStates, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
