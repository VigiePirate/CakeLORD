<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earset $earset
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Earsets',
        'Variety' => __('Earset'),
        'variety' => $earset,
        'tooltip' => __('Browse earset list'),
        'show_staff' => true
    ])
?>
