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
    <h1><?= __('Rats whose owner’s username is like “{0}”', [h(implode('"',$owners))]) ?></h1>
        <?= $this->element('rats', [
            'rubric' => __(''),
            'exceptions' => [
                'picture',
                'age_string',
                'death_cause',
                'actions',
            ],
        ]) ?>
</div>
