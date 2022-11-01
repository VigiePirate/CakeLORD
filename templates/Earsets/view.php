<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earset $earset
 */
?>
<?= $this->element('variety/view', [
        'Varieties' => 'Earsets',
        'Variety' => 'Earsets',
        'variety' => $earset,
        'tooltip' => __('Browse earset list'),
        'show_staff' => $show_staff
    ])
?>
