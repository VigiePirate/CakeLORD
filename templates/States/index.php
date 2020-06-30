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
                    <th><?= $this->Paginator->sort('state_id',$this->Html->image('/img/icon-fa-state.svg', ['class' => 'action-icon']), ['escape' => false])?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('is_default','Default?') ?></th>
                    <th><?= $this->Paginator->sort('needs_user_action','User Action?') ?></th>
                    <th><?= $this->Paginator->sort('needs_staff_action','Staff Action?') ?></th>
                    <th><?= $this->Paginator->sort('is_reliable','Reliable?') ?></th>
                    <th><?= $this->Paginator->sort('is_visible','Visible?') ?></th>
                    <th><?= $this->Paginator->sort('is_searchable','Searchable?') ?></th>
                    <th><?= $this->Paginator->sort('is_frozen','Frozen?') ?></th>
                    <th><?= $this->Paginator->sort('next_ko_state_id','Next OK') ?></th>
                    <th><?= $this->Paginator->sort('next_ko_state_id','Next KO') ?></th>
                    <th><?= $this->Paginator->sort('next_frozen_state_id','Next Frozen') ?></th>
                    <th><?= $this->Paginator->sort('next_thawed_state_id','Next Thawed') ?></th>
                    <th class="actions"><?= $this->Html->image('/img/icon-fa-action.svg', ['class' => 'action-icon'])?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($states as $state): ?>
                <tr>
                    <td><span class="statecolor_<?= h($state->id) ?>"><?= h($state->symbol) ?></span></td>
                    <td><?= $this->Number->format($state->id) ?></td>
                    <td><?= h($state->is_default) ?></td>
                    <td><?= h($state->needs_user_action) ?></td>
                    <td><?= h($state->needs_staff_action) ?></td>
                    <td><?= h($state->is_reliable) ?></td>
                    <td><?= h($state->is_visible) ?></td>
                    <td><?= h($state->is_searchable) ?></td>
                    <td><?= h($state->is_frozen) ?></td>
                    <td><?= $state->has('next_ok_state') ? $state->next_ok_state->id : '' ?></td>
                    <td><?= $state->has('next_ko_state') ? $state->next_ko_state->id : '' ?></td>
                    <td><?= $state->has('next_frozen_state') ? $state->next_frozen_state->id : '' ?></td>
                    <td><?= $state->has('next_thawed_state') ? $state->next_thawed_state->id : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-view.svg', [
                            'url' => ['controller' => 'States', 'action' => 'view', $state->id],
                            'class' => 'action-icon',
                            'alt' => __('See State')]) ?>
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
