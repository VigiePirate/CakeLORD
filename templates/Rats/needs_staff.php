<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>

<div class="rats index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Back office') ?></div>
    </div>
    <h1><?= __('Rat sheets needing staff action') ?></h1>
    <?= $this->element('rats', [ //rats
        'rubric' => __(''),
        'exceptions' => [
            'picture',
            'pup_name',
        ],
    ]) ?>
</div>
