<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<?= $this->element('variety/view', [
        'Varieties' => 'Colors',
        'Variety' => 'Color',
        'variety' => $color,
        'tooltip' => __('Browse color list'),
        'show_staff' => true
    ])
?>
