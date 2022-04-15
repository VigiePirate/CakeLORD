<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Marking $marking
 */
?>
<?= $this->element('variety/add', [
        'Varieties' => 'Markings',
        'Variety' => 'Marking',
        'variety' => $marking,
        'tooltip' => __('Browse marking list'),
        'show_staff' => false
    ])
?>
