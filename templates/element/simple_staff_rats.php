<div class="table-responsive">
    <table class="summary">
        <thead>
                <th><?= __('State') ?></th>
                <th><?= __('Identifier') ?></th>
                <th><?= __('Usual name') ?></th>
                <th><?= __('Owner') ?></th>
                <th><?= __('Modified') ?></th>
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
                    <td> </td>
                    <td class="actions">
                        <span class="nowrap">
                            <?php if (! is_null($rat->last_snapshot_id)) :?>
                                <?= $this->Html->image('/img/icon-diff.svg', [
                                    'url' => ['controller' => 'RatSnapshots', 'action' => 'diff', $rat->last_snapshot_id],
                                    'class' => 'action-icon',
                                    'alt' => __('Diff')])
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
