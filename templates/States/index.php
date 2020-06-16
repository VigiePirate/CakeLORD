<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State[]|\Cake\Collection\CollectionInterface $states
 */
?>
<div class="states index content">
    <?= $this->Html->link(__('New State'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('States') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('color') ?></th>
                    <th><?= $this->Paginator->sort('symbol') ?></th>
                    <th><?= $this->Paginator->sort('css_property') ?></th>
                    <th><?= $this->Paginator->sort('is_default') ?></th>
                    <th><?= $this->Paginator->sort('needs_user_action') ?></th>
                    <th><?= $this->Paginator->sort('needs_staff_action') ?></th>
                    <th><?= $this->Paginator->sort('is_reliable') ?></th>
                    <th><?= $this->Paginator->sort('is_visible') ?></th>
                    <th><?= $this->Paginator->sort('is_searchable') ?></th>
                    <th><?= $this->Paginator->sort('is_frozen') ?></th>
                    <th><?= $this->Paginator->sort('next_ok_state_id') ?></th>
                    <th><?= $this->Paginator->sort('next_ko_state_id') ?></th>
                    <th><?= $this->Paginator->sort('next_frozen_state_id') ?></th>
                    <th><?= $this->Paginator->sort('next_thawed_state_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($states as $state): ?>
                <tr>
                    <td><?= $this->Number->format($state->id) ?></td>
                    <td><?= h($state->name) ?></td>
                    <td><?= h($state->color) ?></td>
                    <td><?= h($state->symbol) ?></td>
                    <td><?= h($state->css_property) ?></td>
                    <td><?= h($state->is_default) ?></td>
                    <td><?= h($state->needs_user_action) ?></td>
                    <td><?= h($state->needs_staff_action) ?></td>
                    <td><?= h($state->is_reliable) ?></td>
                    <td><?= h($state->is_visible) ?></td>
                    <td><?= h($state->is_searchable) ?></td>
                    <td><?= h($state->is_frozen) ?></td>
                    <td><?= $state->has('next_ok_state') ? $this->Html->link($state->next_ok_state->name, ['controller' => 'States', 'action' => 'view', $state->next_ok_state->id]) : '' ?></td>
                    <td><?= $state->has('next_ko_state') ? $this->Html->link($state->next_ko_state->name, ['controller' => 'States', 'action' => 'view', $state->next_ko_state->id]) : '' ?></td>
                    <td><?= $state->has('next_frozen_state') ? $this->Html->link($state->next_frozen_state->name, ['controller' => 'States', 'action' => 'view', $state->next_frozen_state->id]) : '' ?></td>
                    <td><?= $state->has('next_thawed_state') ? $this->Html->link($state->next_thawed_state->name, ['controller' => 'States', 'action' => 'view', $state->next_thawed_state->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $state->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $state->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
