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
    <h1><?= __('Rats adopted by {0}', [h($owner->username)]) ?></h1>
        <?= $this->element('rats', [
            'rubric' => __(''),
            'exceptions' => [
                'picture',
                'pup_name',
                //'age_string',
                //'death_cause',
                'owner_user_id',
                'actions',
            ],
        ]) ?>
</div>
