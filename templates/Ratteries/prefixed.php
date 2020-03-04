<!-- In templates/Ratteries/prefixed.php -->

<h3><?= __('Rats named') ?> "<?= h(implode('"',$prefixes)) ?>"</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <th><?= $this->Paginator->sort('prefix') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('owner_id') ?></th>
                    <th><?= $this->Paginator->sort('country_id') ?></th>
                    <th><?= $this->Paginator->sort('zip_code') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratteries as $rattery): ?>
                <tr>
                    <td><?= $this->Html->image($rattery->picture_thumbnail) ?></td>
                    <td><?= $this->Html->link(h($rattery->prefix), ['controller' => 'Ratteries', 'action' => 'view', $rattery->id]) ?> <?= $rattery->is_alive ? '†' : ''  ?></td>
                    <td><?= h($rattery->name) ?></td>
                    <td><?= $rat->has('owner') ? $this->Html->link($rattery->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rattery->owner_user->id]) : '' ?></td>
                    <td><?= h($rattery->country_id) ?></td>
                    <td><?= h($rattery->zip_code) ?></td>
                    <td><?= h($rat->state->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rat->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rat->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rat->id)]) ?>
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
