<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eyecolor $eyecolor
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Eyecolors',
        'Variety' => __('Eyecolor'),
        'variety' => $eyecolor,
        'tooltip' => __('Browse eyecolor list'),
        'show_staff' => true
    ])
?>
