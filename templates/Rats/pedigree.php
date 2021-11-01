<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to rat sheet') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-fullscreen.svg', [
                        'url' => '#',
                        'class' => 'side-nav-icon',
                        'id' => 'toggle_fullscreen',
                        'alt' => __('Full Screen')]) ?>
                    <span class="tooltiptext"><?= __('Toggle full screen') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-print.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'print', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Print')]) ?>
                    <span class="tooltiptext"><?= __('Print pedigree') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= _('Rat family tree') ?></div>
                <?= $this->element('statebar', ['sheet' => $rat]) ?>
            </div>

            <h1>
                <!-- to be improved -->
                <?= h($rat->usual_name) . '<span class="sexcolor_' . h($rat->sex) . '"> ' . h($rat->sex_symbol) . '</span><span>' . h($rat->is_alive_symbol) . '</span>' ?>
            </h1>

            <!-- d3.js family tree -->
            <div id="fullscreen_container">
                <div id="familytree">
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>

<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js'); ?>
<?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'); ?>
<?= $this->Html->script('familytree'); ?>
<?= $this->Html->script('fullscreen'); ?>
<script>
// box sizes variables; should probably be in rem
var boxWidth = 222,
    boxHeight = 60,
    nodeWidth = 93,
    nodeHeight = 248,
    // duration of transitions in ms
    duration = 440, //500 is fine, 3000 for debug
    // d3 multiplies the node size by this value
    // to calculate the distance between nodes
    sibling_separation = 0.75,
    cousin_separation = 1;
    // data filename
    json = <?= $json ?>;
setup();
</script>
<!-- end family tree -->
