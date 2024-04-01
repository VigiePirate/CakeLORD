<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coat $coat
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Coats',
        'Variety' => __('Coat'),
        'variety' => $coat,
        'tooltip' => __('Browse coat list'),
        'show_staff' => true
    ])
?>
