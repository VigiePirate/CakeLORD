<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contribution $contribution
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contribution->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contribution->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Contributions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contributions form content">
            <?= $this->Form->create($contribution) ?>
            <fieldset>
                <legend><?= __('Edit Contribution') ?></legend>
                <?php
                    echo $this->Form->control('rattery_id', ['options' => $ratteries]);
                    echo $this->Form->control('litter_id', ['options' => $litters]);
                    echo $this->Form->control('contribution_type_id', ['options' => $contributionTypes]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
