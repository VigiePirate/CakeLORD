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
                    <td><?= $this->Html->link($rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $rattery->id]) ?></td>
                    <td><?= h($rattery->name) ?></td>
                    <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->username, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                    <td><?= h($rattery->modified->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td> </td>
                    <td class="actions">
                        <span class="nowrap">
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
