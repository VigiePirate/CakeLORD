<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<?= $this->element('variety/add', [
        'Varieties' => 'Colors',
        'Variety' => 'Color',
        'variety' => $color,
        'tooltip' => __('Browse color list'),
        'show_staff' => false
    ])
?>
