<!-- In templates/Ratteries/owned_by.php -->
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
    <h1><?= __('Ratteries whose owner’s username is like ') . ' ' . __('« ') . h(implode('"',$users)) . __(' »')?></h1> <!-- should be “ ” -->
    <?= $this->element('ratteries', [
        'rubric' => __(''),
        'ratteries' => $ratteries,
        'exceptions' => [
            'picture',
        ],
    ]) ?>
</div>
