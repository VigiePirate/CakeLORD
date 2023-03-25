<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter[]|\Cake\Collection\CollectionInterface $litters
 */
?>

<div class="litters index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Back office') ?></div>
    </div>
    <h1><?= __('Litter sheets needing staff action') ?></h1>
    <?= $this->element('staff_litters') ?>
</div>
