<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>

<div class="ratteries index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Search Results') ?></div>
    </div>
    <h1><?= __('Ratteries in state {0}', [h(implode('"',$inState))]) ?></h1>
        <?= $this->element('ratteries', [ //rats
            'rubric' => __(''),
            'exceptions' => [
                'picture',
            ],
        ]) ?>
</div>
