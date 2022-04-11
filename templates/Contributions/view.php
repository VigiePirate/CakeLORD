<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contribution $contribution
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
                        'url' => ['controller' => 'Contributions', 'action' => 'from-rattery', $contribution->rattery_id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Go back to rattery contribution list') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Contributions', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All contributions')]) ?>
                    <span class="tooltiptext"><?= __('See all contributions') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Contributions',
                    'object' => $contribution
                    ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="contributions view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Contributions') ?></div>
            </div>
            <h1><?= __('Contribution') . ' '. h($contribution->id) ?></h1>
            <table>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $contribution->has('rattery') ? $this->Html->link($contribution->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $contribution->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $contribution->has('litter') ? $this->Html->link($contribution->litter->full_name, ['controller' => 'Litters', 'action' => 'view', $contribution->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Contribution Type') ?></th>
                    <td><?= $contribution->has('contribution_type') ? $this->Html->link($contribution->contribution_type->name, ['controller' => 'ContributionTypes', 'action' => 'view', $contribution->contribution_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contribution->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
