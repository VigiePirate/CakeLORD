<!-- In templates/Ratteries/owned_by.php -->
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery[]|\Cake\Collection\CollectionInterface $ratteries
 */
?>
<div class="ratteries index content">
    <h3><?= __('Ratteries with owner username like') ?> "<?= h(implode('"',$users)) ?>"</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('prefix') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('owner_user_id') ?></th>
                    <th><?= $this->Paginator->sort('birth_year') ?></th>
                    <th><?= $this->Paginator->sort('is_alive') ?></th>
                    <th><?= $this->Paginator->sort('is_generic') ?></th>
                    <th><?= $this->Paginator->sort('district') ?></th>
                    <th><?= $this->Paginator->sort('zip_code') ?></th>
                    <th><?= $this->Paginator->sort('country_id') ?></th>
                    <th><?= $this->Paginator->sort('website') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratteries as $rattery): ?>
                <tr>
                    <td><?= $this->Number->format($rattery->id) ?></td>
                    <td><?= h($rattery->prefix) ?></td>
                    <td><?= h($rattery->name) ?></td>
                    <td><?= $rattery->has('user') ? $this->Html->link($rattery->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rattery->owner_user->id]) : '' ?></td>
                    <td><?= h($rattery->birth_year) ?></td>
                    <td><?= h($rattery->is_alive) ?></td>
                    <td><?= h($rattery->is_generic) ?></td>
                    <td><?= h($rattery->district) ?></td>
                    <td><?= h($rattery->zip_code) ?></td>
                    <td><?= $rattery->has('country') ? $this->Html->link($rattery->country->name, ['controller' => 'Countries', 'action' => 'view', $rattery->country->id]) : '' ?></td>
                    <td><?= h($rattery->website) ?></td>
                    <td><?= h($rattery->picture) ?></td>
                    <td><?= $rattery->has('state') ? $this->Html->link($rattery->state->name, ['controller' => 'States', 'action' => 'view', $rattery->state->id]) : '' ?></td>
                    <td><?= h($rattery->created) ?></td>
                    <td><?= h($rattery->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rattery->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rattery->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rattery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rattery->id)]) ?>
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
