<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State[]|\Cake\Collection\CollectionInterface $states
 */
?>
<div class="states index content">
    <?= $this->Html->link(__('New State'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Sheet States') ?></h1>
    <div class="table-responsive">
        <table class="summary">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('state_id', __('State'))?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('is_default', 'Default?') ?></th>
                    <th><?= $this->Paginator->sort('needs_user_action', 'User Action?') ?></th>
                    <th><?= $this->Paginator->sort('needs_staff_action', 'Staff Action?') ?></th>
                    <th><?= $this->Paginator->sort('is_reliable', 'Reliable?') ?></th>
                    <th><?= $this->Paginator->sort('is_visible', 'Visible?') ?></th>
                    <th><?= $this->Paginator->sort('is_searchable', 'Searchable?') ?></th>
                    <th><?= $this->Paginator->sort('is_frozen', 'Frozen?') ?></th>
                    <th><?= $this->Paginator->sort('next_ok_state_id', 'Next OK') ?></th>
                    <th><?= $this->Paginator->sort('next_ko_state_id', 'Next KO') ?></th>
                    <th><?= $this->Paginator->sort('next_frozen_state_id', 'Next Frozen') ?></th>
                    <th><?= $this->Paginator->sort('next_thawed_state_id', 'Next Thawed') ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($states as $state): ?>
                <tr>
                    <td><span class="statecolor_<?= h($state->id) ?>"><?= h($state->symbol) ?></span></td>
                    <td><?= $this->Html->link($state->id, ['action' => 'view', $state->id]) ?></td>
                    <td><?= $state->is_default ? '✓' : '' ?></td>
                    <td><?= $state->needs_user_action ? '✓' : '' ?></td>
                    <td><?= $state->needs_staff_action ? '✓' : '' ?></td>
                    <td><?= $state->is_reliable ? '✓' : '' ?></td>
                    <td><?= $state->is_visible ? '✓' : '' ?></td>
                    <td><?= $state->is_searchable ? '✓' : '' ?></td>
                    <td><?= $state->is_frozen ? '✓' : '' ?></td>
                    <td><?= $state->has('next_ok_state') ? $state->next_ok_state->id : '' ?></td>
                    <td><?= $state->has('next_ko_state') ? $state->next_ko_state->id : '' ?></td>
                    <td><?= $state->has('next_frozen_state') ? $state->next_frozen_state->id : '' ?></td>
                    <td><?= $state->has('next_thawed_state') ? $state->next_thawed_state->id : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'States', 'action' => 'edit', $state->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit State')
                        ])?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete State')
                                ]),
                                ['action' => 'delete', $state->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $state->id), 'escape' => false]
                            )
                        ?>
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
