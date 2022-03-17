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
                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Inbreeding report') ?></div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <div id="waiting-message" class="message warning">
                Computations are in progress. Please be aware that intermediary results might be incorrect. Thank you for your patience.
            </div>

            <div id="success-message" class="message success hide-everywhere">
                Computations took <span id="cost"></span> seconds and are now finished. <span id="cost-comment"></span>
            </div>

            <h2>Summary</h2>

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
        </div>
    </div>
</div>

<?= $this->Html->css('loading'); ?>
<?= $this->Html->script('inbreeding'); ?>

<script>
    var partialTree = <?php echo $genealogy_json; ?>;
    var ancestorIndex = <?php echo $index_json; ?>;
    window.onload = setTimeout(init(partialTree, ancestorIndex), 250); // a small timeout to let debugkit loading itself...
</script>
