<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Colors',
        'Variety' => __('Color'),
        'variety' => $color,
        'tooltip' => __('Browse color list'),
        'show_staff' => true
    ])
?>
