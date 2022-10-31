<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eyecolor[]|\Cake\Collection\CollectionInterface $eyecolors
 */
?>
<?=
    $this->element('variety/index', [
        'Varieties' => 'Eyecolors',
        'Variety' => 'Eyecolor',
        'varieties' => $eyecolors,
        'texts' => [
            'add' => __('New Eyecolor'),
            'title' => __('All Eyecolors'),
            'alt_view' => __('View eyecolor'),
            'alt_edit' => __('Edit eyecolor'),
            'alt_delete' => __('Delete eyecolor'),
        ]
    ]);
?>
