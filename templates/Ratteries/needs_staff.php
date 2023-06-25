<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery[]|\Cake\Collection\CollectionInterface $ratteries
 */
?>
<?php $this->assign('title', __('Back office')) ?>

<div class="ratteries index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Back office') ?></div>
    </div>
    <h1><?= __('Rattery sheets needing staff action') ?></h1>
    <?= $this->element('staff_ratteries') ?>
</div>
