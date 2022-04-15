<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'States',
                'object' => $state,
                'tooltip' => __('Browse state list'),
                'can_cancel' => true,
                'show_staff' => true
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="states form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('States') ?></div>
            </div>
            <h1><?= __('Edit State') ?></h1>
            <?= $this->Form->create($state) ?>
            <fieldset>
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
