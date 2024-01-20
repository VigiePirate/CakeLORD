<h3><?= h($rubric) ?></h3>
<div class="table-responsive">
    <table class="condensed">
        <thead>
            <?php if (! in_array('state_id', $exceptions)): ?>
                <th><?= $this->Paginator->sort('state_id',__('State')) ?></th>
            <?php endif; ?>
            <?php if (! in_array('is_alive', $exceptions)): ?>
                <th><?= $this->Paginator->sort('is_alive',__('Active?')) ?></th>
            <?php endif; ?>
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
                <th><?= $this->Paginator->sort('Users.username', __('Owner')) ?></th>
            <?php endif; ?>
            <?php if (! in_array('birth_year', $exceptions)): ?>
                <th><?= $this->Paginator->sort('birth_year', ['label' => __x('rattery', 'Birth year')]) ?></th>
            <?php endif; ?>
            <?php if (! in_array('zip_code', $exceptions)): ?>
                <th><?= $this->Paginator->sort('zip_code') ?></th>
            <?php endif; ?>
            <?php if (! in_array('country', $exceptions)): ?>
                <th><?= $this->Paginator->sort('Countries.name', __('Country')) ?></th>
            <?php endif; ?>
            <?php if (! in_array('actions', $exceptions)): ?>
                <th class="actions-title col-head"><?= __('Actions') ?></th>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php foreach($ratteries as $rattery): ?>
                <tr>
                    <?php if (! in_array('state_id', $exceptions)): ?>
                        <td><span class="statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></span></td>
                    <?php endif; ?>
                    <?php if (! in_array('is_alive', $exceptions)): ?>
                        <?php if ($rattery->is_alive) : ?>
                            <td class="sun"><b><?= $rattery->is_alive_symbol ?></b></td>
                        <?php else :?>
                            <td class="rotate"><b><?= $rattery->is_alive_symbol ?></b></td>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (! in_array('picture', $exceptions)): ?>
                        <td><?= isset($rattery->picture_thumbnail) ? $this->Html->image($rattery->picture_thumbnail, ['alt' => $rattery->name]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('prefix', $exceptions)): ?>
                        <td><?= h($rattery->prefix) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('name', $exceptions)): ?>
                        <td><?= $this->Html->link($rattery->name, ['controller' => 'Ratteries', 'action' => 'view', $rattery->id]) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('owner_user', $exceptions)): ?>
                        <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->username, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('birth_year', $exceptions)): ?>
                        <td><?= ($rattery->is_generic || $rattery->birth_year == '0000') ? __('N/A') : h($rattery->birth_year) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('zip_code', $exceptions)): ?>
                        <td><?= $rattery->is_generic ? __('N/A') : h($rattery->zip_code) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('country', $exceptions)): ?>
                        <td><?= $rattery->is_generic ? __('N/A') : h($rattery->country->name) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('actions', $exceptions)): ?>
                        <td class="actions">
                            <?php if (! in_array('website', $exceptions)): ?>
                                <?= $rattery->website ?
                                    $this->Html->image('/img/icon-website.svg', [
                                    'url' => h($rattery->website),
                                    'class' => 'action-icon',
                                    'alt' => __('See Rattery')]) : '' ?>
                            <?php endif; ?>
                            <?= $this->Html->image('/img/icon-view.svg', [
                                'url' => ['controller' => 'Ratteries', 'action' => 'view', $rattery->id],
                                'class' => 'action-icon',
                                'alt' => __('See Rattery')]) ?>
                        </td>
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
