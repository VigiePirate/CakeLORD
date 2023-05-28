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
    <h1><?= __('Rats in state {0}', [h(implode('"',$inState))]) ?></h1>
        <?= $this->element('rats', [ //rats
            'rubric' => __(''),
            'exceptions' => [
                'picture',
                'pup_name',
            ],
        ]) ?>
</div>
