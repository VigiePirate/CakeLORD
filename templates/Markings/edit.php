<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Marking $marking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $marking->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $marking->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Markings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="markings form content">
            <?= $this->Form->create($marking) ?>
            <fieldset>
                <legend><?= __('Edit Marking') ?></legend>
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
