<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter[]|\Cake\Collection\CollectionInterface $litters
 */
?>
<div class="litters index content">
    <?= $this->Html->link(__('New Litter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->element('litters', [
        'rubric' => __('Litters'),
        'litters' => $litters,
        'exceptions' => [
            'birth_date',
            'mating_date',
            'pups_number_stillborn',
        ],
    ]) ?> 
</div>
