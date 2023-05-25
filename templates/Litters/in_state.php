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
    <h1><?= __('Litters in state {0}', [h(implode('"',$inState))]) ?></h1>
        <?= $this->element('litters', [
            'rubric' => __(''),
            'exceptions' => [
                'full_name',
                'pups_number_stillborn',
            ],
        ]) ?>
</div>
