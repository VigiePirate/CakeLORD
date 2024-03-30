<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>

<?php $this->assign('title', __('Virtual Litter')) ?>

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

            <h1><?= __('Virtual litter: {0} × {1}', [h($dam->usual_name), h($sire->usual_name)]) ?></h1>

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
                <div id="familytree"></div>
                <div id="json-data" data-json="<?= htmlspecialchars($json) ?>"></div>
            </div>

            <div class="spacer"></div>
            <h2><?= __('Pedigree analysis') ?></h2>

            <h3><?= __('Summary') ?></h3>

            <div id="json-genealogy" data-json="<?= htmlspecialchars($genealogy_json) ?>"></div>
            <div id="json-index" data-json="<?= htmlspecialchars($index_json) ?>"></div>
            <div id="json-messages" data-json="<?= htmlspecialchars($js_messages) ?>"></div>

            <table class="condensed stats unfold">
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
                    <th><?= __('Coefficient of Inbreeding (5G)') ?></th>
                    <td id="coi5">
                        <?= $this->Html->image('/img/icon-spinner.gif', ['class' => 'action-icon']) ?>
                    </td>
                </tr>

                <tr>
                    <th><?= __('Coefficient of Inbreeding (total)') ?></th>
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

<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js'); ?>
<?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'); ?>
<?= $this->Html->script('inbreeding'); ?>
<?= $this->Html->script('familytree'); ?>
<?= $this->Html->script('fullscreen'); ?>
