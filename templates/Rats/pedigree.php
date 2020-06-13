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
                <?= $this->Html->image('/img/icon-fa-alert.svg', [
                    'url' => ['controller' => 'Conversations', 'action' => 'add'],
                    'class' => 'side-nav-icon',
                    'alt' => __('Report')]) ?>
                <?= $this->Html->image('/img/icon-help.svg', [
                    'url' => ['controller' => 'Articles', 'action' => 'index'],
                    'class' => 'side-nav-icon',
                    'alt' => __('Help')]) ?>
                <div class="spacer"> </div>
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
                    <div class="sexmark sexcolor_<?php echo h($rat->sex) ?>"><?= h($rat->sex_symbol) ?></div>
                    <div class="statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                </div>
            </div>
            <h1><?= h($rat->double_prefix) . ' '. h($rat->name) . '<span>' . h($rat->is_alive_symbol) . '</span>' ?></h1>

            <!-- d3.js  -->
            <div id="familytree">
            </div>
            <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js'); ?>
            <?= $this->Html->script('familytree'); ?>
            <script>
            var boxWidth = 210,
                boxHeight = 70,
                nodeWidth = 100,
                nodeHeight = 240,
                // duration of transitions in ms
                duration = 500,
                // d3 multiplies the node size by this value
                // to calculate the distance between nodes
                separation = 0.8,
                // data filename
                file = "/js/" + "14590" + ".json";        
            setup(file);
            </script>
            <!-- end family tree -->
        </div>
    </div>
</div>
