<div class="table-responsive">
    <table class="summary">
        <thead>
            <th><?= $this->Paginator->sort('state_id', __('State')) ?></th>
            <th><?= $this->Paginator->sort('prefix', __('Prefix')) ?></th>
            <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
            <th><?= $this->Paginator->sort('Users.username', __('Owner')) ?></th>
            <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
            <th class="col-head"><?= __('Last message') ?></th>
            <th class="actions-title col-head"><?= __('Actions') ?></th>
        </thead>
        <tbody>
            <?php foreach($ratteries as $rattery): ?>
                <tr>
                    <td><span class="statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></span></td>
                    <td><?= h($rattery->prefix) ?></td>
                    <td><?= $this->Html->link(h($rattery->name), ['controller' => 'Ratteries', 'action' => 'view', $rattery->id], ['escape' => false]) ?></td>
                    <td><?= h($rattery->user->username) ?></td>
                    <td><?= h($rattery->modified->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td><?= ! empty($rattery->rattery_messages) ? mb_strimwidth($rattery->rattery_messages[0]->content, 0, 64, '...') : '' ?></td>
                    <td class="actions">
                        <span class="nowrap">
                            <?php if (! is_null($rattery->last_snapshot_id)) :?>
                                <?= $this->Html->image('/img/icon-diff.svg', [
                                    'url' => ['controller' => 'RatterySnapshots', 'action' => 'diff', $rattery->last_snapshot_id],
                                    'class' => 'action-icon',
                                    'alt' => __('Compare with last snapshot')])
                                ?>
                            <?php endif; ?>
                            <?= $this->Form->postLink(
                                    $this->Html->image('/img/icon-delete.svg', [
                                        'class' => 'action-icon',
                                        'alt' => __('Delete Rattery')
                                    ]),
                                    ['action' => 'delete', $rattery->id],
                                    ['confirm' => __('Are you sure you want to delete rattery # {0}?', $rattery->id), 'escape' => false]
                                )
                            ?>
                        </span>
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
