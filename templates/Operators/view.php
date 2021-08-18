<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operator $operator
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-report.svg', [
          'url' => ['controller' => 'Conversations', 'action' => 'add'],
          'class' => 'side-nav-icon',
          'alt' => __('Report')]) ?>
      <?= $this->Html->image('/img/icon-help.svg', [
              'url' => ['controller' => 'Articles', 'action' => 'index'],
              'class' => 'side-nav-icon',
              'alt' => __('Help')]) ?>
            <?= $this->Html->link(__('Edit Operator'), ['action' => 'edit', $operator->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Operator'), ['action' => 'delete', $operator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $operator->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Operators'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Operator'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="operators view content">
            <h3><?= h($operator->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Symbol') ?></th>
                    <td><?= h($operator->symbol) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meaning') ?></th>
                    <td><?= h($operator->meaning) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($operator->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Compatibilities') ?></h4>
                <?php if (!empty($operator->compatibilities)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Left Genotype') ?></th>
                            <th><?= __('Operator Id') ?></th>
                            <th><?= __('Right Genotype') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($operator->compatibilities as $compatibilities) : ?>
                        <tr>
                            <td><?= h($compatibilities->id) ?></td>
                            <td><?= h($compatibilities->left_genotype) ?></td>
                            <td><?= h($compatibilities->operator_id) ?></td>
                            <td><?= h($compatibilities->right_genotype) ?></td>
                            <td><?= h($compatibilities->comments) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Compatibilities', 'action' => 'view', $compatibilities->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Compatibilities', 'action' => 'edit', $compatibilities->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Compatibilities', 'action' => 'delete', $compatibilities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $compatibilities->id)]) ?>
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
