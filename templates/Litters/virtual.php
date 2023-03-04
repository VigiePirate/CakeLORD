<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
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
                        'url' => ['controller' => 'Litters', 'action' => 'my'],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to my litters') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-fullscreen.svg', [
                        'url' => '#',
                        'class' => 'side-nav-icon',
                        'id' => 'toggle_fullscreen',
                        'alt' => __('Full Screen')])
                    ?>
                    <span class="tooltiptext"><?= __('Toggle full screen') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>

            <h1><?= __('Virtual litter: ') . h($dam->usual_name) . ' × ' . h($sire->usual_name) ?></h1>

            <div id="waiting-message" class="message warning">
                <?= $this->Html->image('/img/icon-warning-spinner.gif', ['class' => 'action-icon'])
                . ' ' . __('Computations are in progress. Intermediary results might be inexact. Thank you for your patience.')
                . ' ' . $this->Html->image('/img/icon-warning-spinner.gif', ['class' => 'action-icon']) ?>
            </div>

            <div id="success-message" class="message success hide-everywhere">
                <?= __('Computations took {0} seconds and are now finished.', ['<span id="cost"></span>']) ?> <span id="cost-comment"></span>
            </div>

            <h2><?= __('Family tree') ?></h2>
            <!-- d3.js family tree -->
            <div id="fullscreen_container">
                <div id="familytree">
                </div>
            </div>

            <div class="spacer"></div>
            <h2><?= __('Pedigree analysis') ?></h2>

            <h3><?= __('Summary') ?></h3>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Longest family tree branch') ?></th>
                    <td id="max_depth">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Shortest family tree branch') ?></th>
                    <td id="min_depth">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Number of known ancestors') ?></th>
                    <td id="known">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Number of distinct ancestors') ?></th>
                    <td id="distinct">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Number of founding ancestors') ?></th>
                    <td id="founding">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Number of common ancestors') ?></th>
                    <td id="common">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Ancestor loss coefficient (5G)') ?></th>
                    <td id="avk5">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Ancestor loss coefficient (10G)') ?></th>
                    <td class="loading" id="avk10">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Coefficient of Inbreeding') ?></th>
                    <td id="coi">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>
            </table>

            <!-- to be shown if coi > 0 -->
            <div id="coancestry" class="hide-everywhere">
                <h3><?= __('Coancestry analysis') ?></h3>
                <table id="coancestry-table" class="condensed stats histogram">
                    <th>
                        <div id="coancestry-global" style="opacity:1; width:100%">
                        </div>
                    </th>
                    <td>
                        <strong> = <?= __('Global inbreeding coefficient') ?></strong>
                    </td>
                </table>
            </div>



        </div>
    </div>
</div>

<?= $this->Html->css('loading'); ?>
<?= $this->Html->script('inbreeding'); ?>

<script>
    var partialTree = <?php echo $genealogy_json; ?>;
    var ancestorIndex = <?php echo $index_json; ?>;
    window.onload = setTimeout(init(partialTree, ancestorIndex), 250); // a small timeout to let debugkit loading
</script>

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
