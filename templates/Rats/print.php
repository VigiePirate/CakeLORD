<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->start('title') ?>
  <?= h($rat->usual_name) ?>
<?php $this->end() ?>

<div class="rats view content">
    <h1><?= h($rat->pedigree_identifier) ?></h1>

    <table class="printable">
        <tr>
            <td><h2><?= __('Identity') ?></h2></td>
            <td></td>
            <td><h2><?= __('Description') ?></h2></td>
            <td></td>
        </tr>

        <tr>
            <td><?= __('Prefix') ?></td>
            <td><?= h($rat->double_prefix) ?></td>
            <td><?= __('Color') ?></td>
            <td><?= $rat->has('color') ? h($rat->color->name) : '' ?></td>
        </tr>

        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($rat->name) ?></td>
            <td><?= __('Eyecolor') ?></td>
            <td><?= $rat->has('eyecolor') ? h($rat->eyecolor->name) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Pup name') ?></td>
            <td><?= h($rat->pup_name) ?></td>
            <td><?= __('Dilution') ?></td>
            <td><?= $rat->has('dilution') ? h($rat->dilution->name) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Birth date') ?></td>
            <td><?= h($rat->birth_date->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::NONE])) ?></td>
            <td><?= __('Marking') ?></td>
            <td><?= $rat->has('marking') ? h($rat->marking->name) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Birth place') ?></td>
            <td><?= h($rat->rattery->full_name) ?></td>
            <td><?= __('Earset') ?></td>
            <td><?= $rat->has('earset') ? h($rat->earset->name) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Sex') ?></td>
            <td><?= h($rat->sex_name) ?></td>
            <td><?= __('Coat') ?></td>
            <td><?= $rat->has('coat') ? h($rat->coat->name) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Owner') ?></td>
            <td><?= h($rat->owner_user->username) ?></td>
            <td><?= __('Singularities') ?></td>
            <td><?= $rat->singularity_string ?></td>
        </tr>
    </table>

    <h3><?= __('Genealogy') ?></h3>
    <!-- d3.js family tree -->
    <div id="simpletree">
    </div>

    <div class="signature">
        &mdash; <?= __('Created by LORD on {0}, for whatever purpose it may serve, without any liability whatsoever.', [h(date("d/m/Y"))]) ?>
    </div>
</div>

<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js'); ?>
<?= $this->Html->script('jquery.min.js'); ?>
<?= $this->Html->script('simpletree'); ?>
<script>
// box sizes variables; should probably be in rem
var boxWidth = 222,
    boxHeight = 60,
    nodeWidth = 93,
    nodeHeight = 248,
    // duration of transitions in ms
    duration = 0,
    // d3 multiplies the node size by this value
    // to calculate the distance between nodes
    sibling_separation = 0.75,
    cousin_separation = 1;
    depth = <?= $depth ?>;
    // data filename
    json = <?= $json ?>;
setup();
</script>
<!-- end family tree -->
