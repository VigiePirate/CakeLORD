<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Marking $marking
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Markings',
        'Variety' => __('Marking'),
        'variety' => $marking,
        'tooltip' => __('Browse marking list'),
        'show_staff' => true
    ])
?>
