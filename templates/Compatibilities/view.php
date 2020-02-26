<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compatibility $compatibility
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Compatibility'), ['action' => 'edit', $compatibility->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Compatibility'), ['action' => 'delete', $compatibility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $compatibility->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Compatibilities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Compatibility'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="compatibilities view content">
            <h3><?= h($compatibility->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Left Genotype') ?></th>
                    <td><?= h($compatibility->left_genotype) ?></td>
                </tr>
                <tr>
                    <th><?= __('Operator') ?></th>
                    <td><?= $compatibility->has('operator') ? $this->Html->link($compatibility->operator->id, ['controller' => 'Operators', 'action' => 'view', $compatibility->operator->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Right Genotype') ?></th>
                    <td><?= h($compatibility->right_genotype) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($compatibility->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($compatibility->comments)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
