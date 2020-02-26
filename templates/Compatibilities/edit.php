<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compatibility $compatibility
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $compatibility->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $compatibility->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Compatibilities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="compatibilities form content">
            <?= $this->Form->create($compatibility) ?>
            <fieldset>
                <legend><?= __('Edit Compatibility') ?></legend>
                <?php
                    echo $this->Form->control('left_genotype');
                    echo $this->Form->control('operator_id', ['options' => $operators]);
                    echo $this->Form->control('right_genotype');
                    echo $this->Form->control('comments');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
