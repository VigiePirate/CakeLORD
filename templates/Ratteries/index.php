<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery[]|\Cake\Collection\CollectionInterface $ratteries
 */
?>

<?php $this->assign('title', __('All Ratteries')) ?>

<div class="ratteries index content">
    <?= $this->Html->link(__('New Rattery'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Ratteries') ?></h1>
    <?= $this->element('ratteries', [
        'rubric' => __(''),
        'ratteries' => $ratteries,
        'exceptions' => [
            'picture',
        ],
    ]) ?>
</div>
