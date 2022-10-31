<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\dilution $dilution
 */
?>
<?= $this->element('variety/view', [
        'Varieties' => 'Dilutions',
        'Variety' => 'Dilution',
        'variety' => $dilution,
        'tooltip' => __('Browse dilution list'),
        'show_staff' => $show_staff
    ])
?>
