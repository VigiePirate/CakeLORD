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
    <h1><?= __('Litters in state ') . ' ' . __('« ') . h(implode('"',$inState)) . __(' »')?></h1> <!-- should be “ ” -->
        <?= $this->element('litters', [
            'rubric' => __(''),
            'exceptions' => [
                'full_name',
                'pups_number_stillborn',
            ],
        ]) ?>
</div>
