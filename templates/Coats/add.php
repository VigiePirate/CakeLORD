<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coat $coat
 */
?>
<?= $this->element('variety/add', [
        'Varieties' => 'Coats',
        'Variety' => 'Coat',
        'variety' => $coat,
        'tooltip' => __('Browse coat list'),
        'show_staff' => false
    ])
?>
