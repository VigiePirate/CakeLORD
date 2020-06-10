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
            <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
            <iframe src="http://justincy.github.io/d3-pedigree-examples/descendants-oop.html" width="100%" height="75vh">
            </iframe>
            <!-- end copy-paste example -->
        </div>
    </div>
</div>
