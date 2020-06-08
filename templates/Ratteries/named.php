<!-- In templates/Ratteries/prefixed.php -->
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery[]|\Cake\Collection\CollectionInterface $ratteries
 */
?>

<div class="ratteries index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Search Results') ?></div>
    </div>
    <h1><?= __('Ratteries with name or prefix like ') . ' ' . __('« ') . h(implode('"',$names)) . __(' »')?></h1> <!-- should be “ ” -->
    <?= $this->element('ratteries', [
        'rubric' => __(''),
        'ratteries' => $ratteries,
        'exceptions' => [
            'picture',
        ],
    ]) ?>
</div>
