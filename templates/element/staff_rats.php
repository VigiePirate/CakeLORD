<div class="table-responsive">
    <table class="summary">
        <thead>
                <th><?= $this->Paginator->sort('state_id', __('State')) ?></th>
                <th><?= $this->Paginator->sort('pedigree_identifier', __('Identifier')) ?></th>
                <th><?= __('Usual name') ?></th>
                <th><?= $this->Paginator->sort('OwnerUsers.username', __('Owner')) ?></th>
                <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                <th><?= __('Last message') ?></th>
                <th class="actions-title"><?= __('Actions') ?></th>
        </thead>
        <tbody>
            <?php foreach($rats as $rat): ?>
                <tr>
                    <td><span class="statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></span></td>
                    <td><?= $this->Html->link($rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $rat->id]) ?></td>
                    <td><?= h($rat->usual_name) ?></td>
                    <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                    <td><?= h($rat->modified->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td><?= ! empty($rat->rat_messages) ? mb_strimwidth($rat->rat_messages[0]->content, 0, 64, '...') : '' ?></td>
                    <td class="actions">
                        <span class="nowrap">
                            <?php if (! is_null($rat->last_snapshot_id)) :?>
                                <?= $this->Html->image('/img/icon-diff.svg', [
                                    'url' => ['controller' => 'RatSnapshots', 'action' => 'diff', $rat->last_snapshot_id],
                                    'class' => 'action-icon',
                                    'alt' => __('Compare with last snapshot')])
                                ?>
                            <?php endif; ?>
                            <?= $this->Form->postLink(
                                    $this->Html->image('/img/icon-delete.svg', [
                                        'class' => 'action-icon',
                                        'alt' => __('Delete Rat')
                                    ]),
                                    ['action' => 'delete', $rat->id],
                                    ['confirm' => __('Are you sure you want to delete rat # {0}?', $rat->id), 'escape' => false]
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
