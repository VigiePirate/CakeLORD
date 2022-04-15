<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earset[]|\Cake\Collection\CollectionInterface $earsets
 */
?>
<?=
    $this->element('variety/index', [
        'Varieties' => 'Earsets',
        'Variety' => 'Earset',
        'varieties' => $earsets,
        'texts' => [
            'add' => __('New Earset'),
            'title' => __('All Earsets'),
            'alt_edit' => __('Edit earset'),
            'alt_delete' => __('Delete earset'),
        ]
    ]);
?>
