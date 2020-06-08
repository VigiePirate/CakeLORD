<h3><?= h($rubric) ?></h3>
<div class="table-responsive">
    <table class="summary">
        <thead>
            <?php if (! in_array('state_id', $exceptions)): ?>
                <th><?= $this->Html->image('/img/icon-fa-state.svg', ['class' => 'action-icon']) ?></th>
            <?php endif; ?>
            <?php if (! in_array('is_alive', $exceptions)): ?>
                <th><?= __('On?')?></th>
            <?php endif; ?>
            <?php if (! in_array('picture', $exceptions)): ?>
                <th><?= __('picture') ?></th>
            <?php endif; ?>
            <?php if (! in_array('prefix', $exceptions)): ?>
                <th><?= __('Prefix') ?></th>
            <?php endif; ?>
            <?php if (! in_array('name', $exceptions)): ?>
                <th><?= __('Name') ?></th>
            <?php endif; ?>
            <?php if (! in_array('owner_user', $exceptions)): ?>
                <th><?= __('Owner') ?></th>
            <?php endif; ?>
            <?php if (! in_array('birth_year', $exceptions)): ?>
                <th><?= __('Birth year') ?></th>
            <?php endif; ?>
            <?php if (! in_array('zip_code', $exceptions)): ?>
                <th><?= __('Zip code') ?></th>
            <?php endif; ?>
            <?php if (! in_array('country', $exceptions)): ?>
                <th><?= __('Country') ?></th>
            <?php endif; ?>
            <th class="actions-title"><?= $this->Html->image('/img/icon-fa-action.svg', ['class' => 'action-icon'])?></th>
        </thead>
        <tbody>
            <?php foreach($ratteries as $rattery): ?>
                <tr>
                    <?php if (! in_array('state_id', $exceptions)): ?>
                        <td><span class="statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></span></td>
                    <?php endif; ?>
                    <?php if (! in_array('is_alive', $exceptions)): ?>
                        <td><?= $rattery->is_alive ? $this->Html->image('/img/icon-on.svg',['width' => '22','alt' => 'Rattery is on']) : $this->Html->image('/img/icon-off.svg',['width' => '22','alt' => 'Rattery is off']) ?></td>
                    <?php endif; ?>
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
                        <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->username, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('birth_year', $exceptions)): ?>
                        <td><?= h($rattery->birth_year) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('zip_code', $exceptions)): ?>
                        <td><?= h($rattery->zip_code) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('country', $exceptions)): ?>
                        <td><?= h($rattery->country->name) ?></td>
                    <?php endif; ?>
                    <td class="actions">
                        <?php if (! in_array('website', $exceptions)): ?>
                            <?= $rattery->website ?
                                $this->Html->image('/img/icon-web.svg', [
                                'url' => h($rattery->website),
                                'class' => 'action-icon',
                                'alt' => __('See Rattery')]) : '' ?>
                        <?php endif; ?>
                        <?= $this->Html->image('/img/icon-fa-eye.svg', [
                            'url' => ['controller' => 'Ratteries', 'action' => 'view', $rattery->id],
                            'class' => 'action-icon',
                            'alt' => __('See Rattery')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
