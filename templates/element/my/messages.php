<h4><?= __('My Messages') ?></h4>
<?php if (!empty($user->conversations)) : ?>
<div class="table-responsive">
    <table>
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Rat Id') ?></th>
            <th><?= __('Rattery Id') ?></th>
            <th><?= __('Litter Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Is Active') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->conversations as $conversations) : ?>
        <tr>
            <td><?= h($conversations->id) ?></td>
            <td><?= h($conversations->rat_id) ?></td>
            <td><?= h($conversations->rattery_id) ?></td>
            <td><?= h($conversations->litter_id) ?></td>
            <td><?= h($conversations->created) ?></td>
            <td><?= h($conversations->modified) ?></td>
            <td><?= h($conversations->is_active) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Conversations', 'action' => 'view', $conversations->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Conversations', 'action' => 'edit', $conversations->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Conversations', 'action' => 'delete', $conversations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conversations->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>
