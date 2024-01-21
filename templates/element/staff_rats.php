<div class="table-responsive">
    <table class="summary">
        <thead>
                <th><?= $this->Paginator->sort('state_id', __('State')) ?></th>
                <th><?= $this->Paginator->sort('pedigree_identifier', __('Identifier')) ?></th>
                <th class="col-head"><?= __('Usual name') ?></th>
                <th><?= $this->Paginator->sort('OwnerUsers.username', __('Owner')) ?></th>
                <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                <th class="col-head"><?= __('Last message') ?></th>
                <th class="actions-title col-head"><?= __('Actions') ?></th>
        </thead>
        <tbody>
            <?php foreach($rats as $rat): ?>
                <tr>
                    <td><span class="statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></span></td>
                    <td><?= $this->Html->link($rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $rat->id]) ?></td>
                    <td><?= h($rat->usual_name) ?></td>
                    <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                    <td><?= h($rat->modified->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td class="ellipsis" onclick="toggleMessage(this)"><?= ! empty($rat->rat_messages) ? h($rat->rat_messages[0]->content) : '' ?></td>
                    <td class="actions">
                        <span class="nowrap">
                            <?php if (! is_null($rat->last_snapshot_id)) :?>
                                <?= $this->Html->image('/img/icon-diff.svg', [
                                    'url' => ['controller' => 'RatSnapshots', 'action' => 'diff', $rat->last_snapshot_id],
                                    'class' => 'action-icon',
                                    'alt' => __('Compare with last snapshot')])
                                ?>
                            <?php endif; ?>
                            <?php if (! is_null($user) && $user->can('delete', $rat)) : ?>
                                <?= $this->Html->image('/img/icon-delete.svg', [
                                    'url' => ['controller' => 'Rats', 'action' => 'delete', $rat->id],
                                    'class' => 'action-icon',
                                    'alt' => __('Delete Litter')
                                ])?>
                            <?php else :?>
                                <span class="disabled">
                                    <?= $this->Html->image('/img/icon-delete.svg', [
                                        'url' => '',
                                        'class' => 'action-icon disabled',
                                        'alt' => __('Delete Litter')])
                                    ?>
                                </span>
                            <?php endif ;?>
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
