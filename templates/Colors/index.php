<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color[]|\Cake\Collection\CollectionInterface $colors
 */
?>
<?=
    $this->element('variety/index', [
        'Varieties' => 'Colors',
        'Variety' => 'Color',
        'varieties' => $colors,
        'texts' => [
            'add' => __('New Color'),
            'title' => __('All Colors'),
            'alt_view' => __('View color'),
            'alt_edit' => __('Edit color'),
            'alt_delete' => __('Delete color'),
        ]
    ]);
?>
