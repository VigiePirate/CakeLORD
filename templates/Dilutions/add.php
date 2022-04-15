<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dilution $dilution
 */
?>
<?= $this->element('variety/add', [
        'Varieties' => 'Dilutions',
        'Variety' => 'Dilution',
        'variety' => $dilution,
        'tooltip' => __('Browse dilution list'),
        'show_staff' => false
    ])
?>
