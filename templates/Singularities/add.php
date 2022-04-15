<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Singularity $singularity
 */
?>
<?= $this->element('variety/add', [
        'Varieties' => 'Singularities',
        'Variety' => 'Singularity',
        'variety' => $singularity,
        'tooltip' => __('Browse singularity list'),
        'show_staff' => false
    ])
?>
