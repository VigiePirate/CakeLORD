<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Marking[]|\Cake\Collection\CollectionInterface $markings
 */
?>
<?=
    $this->element('variety/index', [
        'Varieties' => 'Markings',
        'Variety' => 'Marking',
        'varieties' => $markings,
        'texts' => [
            'add' => __('New Marking'),
            'title' => __('All Markings'),
            'alt_view' => __('View marking'),
            'alt_edit' => __('Edit marking'),
            'alt_delete' => __('Delete marking'),
        ]
    ]);
?>
