<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\coat $coat
 */
?>
<?= $this->element('variety/view', [
        'Varieties' => 'Coats',
        'Variety' => 'Coat',
        'variety' => $coat,
        'tooltip' => __('Browse coat list'),
        'show_staff' => $show_staff
    ])
?>
