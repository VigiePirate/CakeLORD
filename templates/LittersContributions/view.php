<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LittersContribution $littersContribution
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Litters Contribution'), ['action' => 'edit', $littersContribution->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Litters Contribution'), ['action' => 'delete', $littersContribution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $littersContribution->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Litters Contributions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Litters Contribution'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="littersContributions view content">
            <h3><?= h($littersContribution->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($littersContribution->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($littersContribution->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Priority') ?></th>
                    <td><?= $this->Number->format($littersContribution->priority) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Ratteries Litters') ?></h4>
                <?php if (!empty($littersContribution->ratteries_litters)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Litters Contribution Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($littersContribution->ratteries_litters as $ratteriesLitters) : ?>
                        <tr>
                            <td><?= h($ratteriesLitters->rattery_id) ?></td>
                            <td><?= h($ratteriesLitters->litter_id) ?></td>
                            <td><?= h($ratteriesLitters->litters_contribution_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RatteriesLitters', 'action' => 'view', $ratteriesLitters->rattery_id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RatteriesLitters', 'action' => 'edit', $ratteriesLitters->rattery_id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RatteriesLitters', 'action' => 'delete', $ratteriesLitters->rattery_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratteriesLitters->rattery_id)]) ?>
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
