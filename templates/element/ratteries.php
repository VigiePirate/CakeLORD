<h3><?= h($rubric) ?></h3>
<div class="table-responsive">
    <table>
        <thead>
                <?php if (! in_array('picture', $exceptions)): ?>
                    <th><?= __('picture') ?></th>
                <?php endif; ?>
                <?php if (! in_array('prefix', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('prefix') ?></th>
                <?php endif; ?>
                <?php if (! in_array('name', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('name') ?></th>
                <?php endif; ?>
                <?php if (! in_array('owner_user', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('owner_user') ?></th>
                <?php endif; ?>
                <?php if (! in_array('birth_year', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('birth_year') ?></th>
                <?php endif; ?>
                <?php if (! in_array('country', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('country') ?></th>
                <?php endif; ?>
                <?php if (! in_array('website', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('website') ?></th>
                <?php endif; ?>
                <?php if (! in_array('state', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('state') ?></th>
                <?php endif; ?>
        </thead>
        <tbody>
            <?php foreach($ratteries as $rattery): ?>
                <tr>
                    <?php if (! in_array('picture', $exceptions)): ?>
                        <td><?= isset($rattery->picture_thumbnail) ? $this->Html->image($rattery->picture_thumbnail, ['alt' => $rattery->name]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('prefix', $exceptions)): ?>
                        <td><?= $this->Html->link($rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $rattery->id]) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('name', $exceptions)): ?>
                        <td><?= h($rattery->name) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('owner_user', $exceptions)): ?>
                        <td><?= $rattery->has('owner_user') ? $this->Html->link($rattery->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rattery->owner_user->id]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('birth_year', $exceptions)): ?>
                        <td><?= h($rattery->birth_year) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('country', $exceptions)): ?>
                        <td><?= h($rattery->country) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('website', $exceptions)): ?>
                        <td><?= $rattery->website ? $this->Html->link(h($rattery->website)) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('state', $exceptions)): ?>
                        <td><?= $rattery->has('state') ? $this->Html->link($rattery->state->name, ['controller' => 'States', 'action' => 'view', $rattery->state->id]) : '' ?></td>
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
