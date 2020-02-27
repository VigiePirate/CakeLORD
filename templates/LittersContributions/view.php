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
        </div>
    </div>
</div>
