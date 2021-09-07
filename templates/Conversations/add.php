<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conversation $conversation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="conversations form content">
            <?= $this->Form->create($conversation) ?>
            <fieldset>
                <legend><?= __('Add Conversation') ?></legend>
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
