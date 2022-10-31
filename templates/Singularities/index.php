<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Singularity[]|\Cake\Collection\CollectionInterface $singularities
 */
?>
<?=
    $this->element('variety/index', [
        'Varieties' => 'Singularities',
        'Variety' => 'Singularity',
        'varieties' => $singularities,
        'texts' => [
            'add' => __('New Singularity'),
            'title' => __('All Singularities'),
            'alt_view' => __('View singularity'),
            'alt_edit' => __('Edit singularity'),
            'alt_delete' => __('Delete singularity'),
        ]
    ]);
?>
