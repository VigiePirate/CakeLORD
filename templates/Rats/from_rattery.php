<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>

<div class="rats index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Search Results') ?></div>
    </div>
    <h1><?= __('Rats from rattery with name or prefix like') . ' ' . __('« ') . h(implode('"',$ratteries)) . __(' »')?></h1> <!-- should be “ ” -->
        <?= $this->element('rats', [ //rats
            'rubric' => __(''),
            'exceptions' => [
                'picture',
                'age_string',
                'death_cause',
            ],
        ]) ?>
</div>
