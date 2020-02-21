<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery $rattery
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Ratteries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratteries form content">
            <?= $this->Form->create($rattery) ?>
            <fieldset>
                <legend><?= __('Add Rattery') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('prefix');
                    echo $this->Form->control('owner_id', ['options' => $users]);
                    echo $this->Form->control('comments');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('status');
                    echo $this->Form->control('validated');
                    echo $this->Form->control('date_birth');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
