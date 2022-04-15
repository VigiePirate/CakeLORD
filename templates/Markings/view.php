<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\marking $marking
 */
?>
<?= $this->element('variety/view', [
        'Varieties' => 'Markings',
        'Variety' => 'Marking',
        'variety' => $marking,
        'tooltip' => __('Browse marking list'),
        'show_staff' => true
    ])
?>
