<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>

<?php $this->assign('title', __('Search')) ?>

<div class="rats index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Search Results') ?></div>
    </div>
    <h1><?= __('Rats born before') . ' ' . h(implode('"',$bornBefore)) ?></h1>
        <?= $this->element('rats', [ //rats
            'rubric' => __(''),
            'exceptions' => [
                'picture',
                'actions',
                //'age_string',
                //'death_cause',
            ],
        ]) ?>
</div>
