<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav">
                <?= $this->element('default_sidebar') ?>
                <div class="spacer"> </div>
                <?= $this->Html->image('/img/icon-fullscreen.svg', [
                    'url' => '#',
                    'class' => 'side-nav-icon',
                    'id' => 'toggle_fullscreen',
                    'alt' => __('Full Screen')]) ?>
                <?= $this->Html->image('/img/icon-print.svg', [
                    'url' => ['controller' => 'Rats', 'action' => 'print',$rat->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Print')]) ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle">Rat Family Tree</div>
                <div class="sheet-markers">
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($rat->state->name) ?></span>
                    </div>
                </div>
            </div>
            <h1><?= h($rat->usual_name) . '<span class="sexcolor_' . h($rat->sex) . '"> ' . h($rat->sex_symbol) . '</span><span>' . h($rat->is_alive_symbol) . '</span>' ?></div>

            <!-- d3.js family tree -->
            <div id="fullscreen_container">
                <div id="familytree">
                </div>
            </div>
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
        </div>
    </div>
</div>
