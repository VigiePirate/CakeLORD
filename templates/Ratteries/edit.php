<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery $rattery
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rattery->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rattery->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Ratteries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries form content">
            <?= $this->Form->create($rattery) ?>
            <fieldset>
                <legend><?= __('Edit Rattery') ?></legend>
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
