<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Singularity $singularity
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Singularities',
        'Variety' => __('Singularity'),
        'variety' => $singularity,
        'tooltip' => __('Browse singularity list'),
        'show_staff' => true
    ])
?>
