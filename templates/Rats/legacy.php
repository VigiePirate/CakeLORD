<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>

<?php $this->assign('title', __('Descendance of {0}', [$rat->usual_name])) ?>

<div class="rats index content">
    <h1><?= __('Alive Descendance of {0}', [$rat->usual_name]) ?></h1>
    <?= $this->element('rats', [ //rats
        'rubric' => __(''),
        'exceptions' => [
            'picture',
            'birth_date',
            'age_string',
            'death_cause',
            'actions',
        ],
    ]) ?>
</div>
