<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dilution[]|\Cake\Collection\CollectionInterface $dilutions
 */
?>
<?=
    $this->element('variety/index', [
        'Varieties' => 'Dilutions',
        'Variety' => 'Dilution',
        'varieties' => $dilutions,
        'texts' => [
            'add' => __('New Dilution'),
            'title' => __('All Dilutions'),
            'alt_edit' => __('Edit dilution'),
            'alt_delete' => __('Delete dilution'),
        ]
    ]);
?>
