<?php if ($ratteries->count()) : ?>
    <div class="table-responsive">
        <table class="summary">
            <thead>
                <th><?= __('State')?></th>
                <th><?= __('Prefix') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Owner') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Last message') ?></th>
                <th class="actions-title"><?= __('Actions') ?></th>
            </thead>
            <tbody>
                <?php foreach($ratteries as $rattery): ?>
                    <tr>
                        <td><span class="statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></span></td>
                        <td><?= h($rattery->prefix) ?></td>
                        <td><?= $this->Html->link(h($rattery->name), ['controller' => 'Ratteries', 'action' => 'view', $rattery->id], ['escape' => false]) ?></td>
                        <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->username, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                        <td><?= h($rattery->modified->i18nFormat('dd/MM/yyyy')) ?></td>
                        <td><?= ! empty($rattery->rattery_messages) ? mb_strimwidth($rattery->rattery_messages[0]->content, 0, 48, '...') : '' ?></td>
                        <td class="actions">
                            <span class="nowrap">
                                <?php if (! is_null($rattery->last_snapshot_id)) :?>
                                    <?= $this->Html->image('/img/icon-diff.svg', [
                                        'url' => ['controller' => 'RatterySnapshots', 'action' => 'diff', $rattery->last_snapshot_id],
                                        'class' => 'action-icon',
                                        'alt' => __('Diff')])
                                    ?>
                                <?php endif; ?>
                                <?php if (! is_null($user) && $user->can('delete', $rattery)) : ?>
                                    <?= $this->Html->image('/img/icon-delete.svg', [
                                        'url' => ['controller' => 'Ratteries', 'action' => 'delete', $rattery->id],
                                        'class' => 'action-icon',
                                        'alt' => __('Delete Rattery')
                                    ])?>
                                <?php else :?>
                                    <span class="disabled">
                                        <?= $this->Html->image('/img/icon-delete.svg', [
                                            'url' => '',
                                            'class' => 'action-icon disabled',
                                            'alt' => __('Delete Rattery')])
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
<?php endif ; ?>
