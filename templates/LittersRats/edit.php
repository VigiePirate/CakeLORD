<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LittersRat $littersRat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $littersRat->litters_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $littersRat->litters_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Litters Rats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="littersRats form content">
            <?= $this->Form->create($littersRat) ?>
            <fieldset>
                <legend><?= __('Edit Litters Rat') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
