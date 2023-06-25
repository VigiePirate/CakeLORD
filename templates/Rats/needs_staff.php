<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>

<?php $this->assign('title', __('Back office')) ?>

<div class="rats index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Back office') ?></div>
    </div>
    <h1><?= __('Rat sheets needing staff action') ?></h1>
    <?= $this->element('staff_rats') ?>
</div>
