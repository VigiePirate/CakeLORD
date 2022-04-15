<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contribution $contribution
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Contributions',
                'object' => $contribution,
                'tooltip' => __('Browse contributions list'),
                'show_staff' => false,
                'is_labo' => false
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="contributions view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Contributions') ?></div>
            </div>
            <h1><?= __('Contribution') . ' '. h($contribution->id) ?></h1>
            <table class="condensed">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contribution->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $contribution->has('rattery') ? $this->Html->link($contribution->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $contribution->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Contribution Type') ?></th>
                    <td><?= $contribution->has('contribution_type') ? $this->Html->link($contribution->contribution_type->name, ['controller' => 'ContributionTypes', 'action' => 'view', $contribution->contribution_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $contribution->has('litter') ? $this->Html->link($contribution->litter->full_name, ['controller' => 'Litters', 'action' => 'view', $contribution->litter->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
