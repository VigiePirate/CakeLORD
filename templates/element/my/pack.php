<h3><?= h($rubric) ?></h3>
<div class="table-responsive">
    <table>
        <thead>
                <th><?= h('picture') ?></th>
                <th><?= $this->Paginator->sort('pedigree_identifier') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('pup_name') ?></th>
                <th><?= $this->Paginator->sort('birth_date') ?></th>
                <th><?= $this->Paginator->sort('age_string') ?></th>
                <th><?= $this->Paginator->sort('owner_user_id') ?></th>
                <th><?= $this->Paginator->sort('sex') ?></th>
                <th><?= $this->Paginator->sort('state_id') ?></th>
        </thead>
        <tbody>
            <?php foreach($rats as $rat): ?>
                <tr>
                    <td><?= isset($rat->picture_thumbnail) ? $this->Html->image($rat->picture_thumbnail, ['alt' => $rat->name]) : '' ?></td>
                    <td><?= $this->Html->link($rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $rat->id]) ?></td>
                    <td><?= h($rat->name) ?></td>
                    <td><?= h($rat->pup_name) ?></td>
                    <td><?= h($rat->birth_date) ?></td>
                    <td><?= h($rat->age_string) ?></td>
                    <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                    <td><?= h($rat->sex) ?></td>
                    <td><?= $rat->has('state') ? $this->Html->link($rat->state->name, ['controller' => 'States', 'action' => 'view', $rat->state->id]) : '' ?></td>
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
