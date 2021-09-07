<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContributionType $contributionType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('Edit Contribution Type'), ['action' => 'edit', $contributionType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contribution Type'), ['action' => 'delete', $contributionType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contributionType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contribution Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contribution Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contributionTypes view content">
            <h3><?= h($contributionType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contributionType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contributionType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Priority') ?></th>
                    <td><?= $this->Number->format($contributionType->priority) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Contributions') ?></h4>
                <?php if (!empty($contributionType->contributions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Contribution Type Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($contributionType->contributions as $contributions) : ?>
                        <tr>
                            <td><?= h($contributions->id) ?></td>
                            <td><?= h($contributions->rattery_id) ?></td>
                            <td><?= h($contributions->litter_id) ?></td>
                            <td><?= h($contributions->contribution_type_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Contributions', 'action' => 'view', $contributions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Contributions', 'action' => 'edit', $contributions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contributions', 'action' => 'delete', $contributions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contributions->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
