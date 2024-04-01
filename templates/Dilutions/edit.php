<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dilution $dilution
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Dilutions',
        'Variety' => __('Dilution'),
        'variety' => $dilution,
        'tooltip' => __('Browse dilution list'),
        'show_staff' => true
    ])
?>
