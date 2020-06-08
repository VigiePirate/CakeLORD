<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>
<div class="rats index content">
    <?= $this->Html->link(__('New Rat'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h1><?= __('All Rats') ?></h1>
    <?= $this->element('rats', [ //rats
        'rubric' => __(''),
        'exceptions' => [
            'picture',
            'birth_date',
            'age_string',
            'death_cause',
        ],
    ]) ?>
</div>
