<h3><?= h($rubric) ?></h3>
<div class="table-responsive">
    <table>
        <thead>
                <?php if (! in_array('picture', $exceptions)): ?>
                    <th><?= __('picture') ?></th>
                <?php endif; ?>
                <?php if (! in_array('pedigree_identifier', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('pedigree_identifier') ?></th>
                <?php endif; ?>
                <?php if (! in_array('name', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('name') ?></th>
                <?php endif; ?>
                <?php if (! in_array('pup_name', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('pup_name') ?></th>
                <?php endif; ?>
                <?php if (! in_array('birth_date', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('birth_date') ?></th>
                <?php endif; ?>
                <?php if (! in_array('age_string', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('age_string') ?></th>
                <?php endif; ?>
                <?php if (! in_array('owner_user_id', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('owner_user_id') ?></th>
                <?php endif; ?>
                <?php if (! in_array('sex', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('sex') ?></th>
                <?php endif; ?>
                <?php if (! in_array('state_id', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                <?php endif; ?>
        </thead>
        <tbody>
            <?php foreach($rats as $rat): ?>
                <tr>
                    <?php if (! in_array('picture', $exceptions)): ?>
                        <td><?= isset($rat->picture_thumbnail) ? $this->Html->image($rat->picture_thumbnail, ['alt' => $rat->name]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('pedigree_identifier', $exceptions)): ?>
                        <td><?= $this->Html->link($rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $rat->id]) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('name', $exceptions)): ?>
                        <td><?= h($rat->name) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('pup_name', $exceptions)): ?>
                        <td><?= h($rat->pup_name) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('birth_date', $exceptions)): ?>
                        <td><?= h($rat->birth_date) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('age_string', $exceptions)): ?>
                        <td><?= h($rat->age_string) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('owner_user_id', $exceptions)): ?>
                        <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('sex', $exceptions)): ?>
                        <td><?= h($rat->sex) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('state_id', $exceptions)): ?>
                        <td><?= $rat->has('state') ? $this->Html->link($rat->state->name, ['controller' => 'States', 'action' => 'view', $rat->state->id]) : '' ?></td>
                    <?php endif; ?>
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
