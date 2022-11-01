<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eyecolor $eyecolor
 */
?>
<?= $this->element('variety/view', [
        'Varieties' => 'Eyecolors',
        'Variety' => 'Eyecolor',
        'variety' => $eyecolor,
        'tooltip' => __('Browse eyecolor list'),
        'show_staff' => $show_staff
    ])
?>
