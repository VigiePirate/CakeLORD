<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Incompatibility $incompatibility
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $incompatibility->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $incompatibility->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Incompatibilities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="incompatibilities form content">
            <?= $this->Form->create($incompatibility) ?>
            <fieldset>
                <legend><?= __('Edit Incompatibility') ?></legend>
                <?php
                    echo $this->Form->control('genotype1');
                    echo $this->Form->control('genotype2');
                    echo $this->Form->control('comments');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
