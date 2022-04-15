<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coat[]|\Cake\Collection\CollectionInterface $coats
 */
?>
<?=
    $this->element('variety/index', [
        'Varieties' => 'Coats',
        'Variety' => 'Coat',
        'varieties' => $coats,
        'texts' => [
            'add' => __('New Coat'),
            'title' => __('All Coats'),
            'alt_edit' => __('Edit coat'),
            'alt_delete' => __('Delete coat'),
        ]
    ]);
?>
