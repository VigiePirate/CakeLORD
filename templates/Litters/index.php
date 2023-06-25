<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter[]|\Cake\Collection\CollectionInterface $litters
 */
?>

<?php $this->assign('title', __('All Litters')) ?>

<div class="litters index content">
    <?= $this->Html->link(__('New Litter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h1><?= __('All Litters') ?></h1>
    <?= $this->element('litters', [
        'rubric' => '',
        'litters' => $litters,
        'exceptions' => [
            'full_name',
            'mating_date',
            'pups_number_stillborn',
        ],
    ]) ?>
</div>
