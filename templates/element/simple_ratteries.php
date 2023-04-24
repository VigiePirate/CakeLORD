<h3><?= h($rubric) ?></h3>
<div class="table-responsive">
    <table class="summary">
        <thead>
            <?php if (! in_array('state_id', $exceptions)): ?>
                <th><?= __('State')?></th>
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
                <th><?= __x('rattery', 'Birth year') ?></th>
            <?php endif; ?>
            <?php if (! in_array('zip_code', $exceptions)): ?>
                <th><?= __('Zip code') ?></th>
            <?php endif; ?>
            <?php if (! in_array('country', $exceptions)): ?>
                <th><?= __('Country') ?></th>
            <?php endif; ?>
            <?php if (! in_array('website', $exceptions)): ?>
                <th class="actions-title"><?= __('Website') ?></th>
            <?php endif; ?>
            <?php if (! in_array('actions', $exceptions)): ?>
                <th class="actions-title"><?= __('Actions') ?></th>
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
                        <td><?= $this->Html->link(h($rattery->name), ['controller' => 'Ratteries', 'action' => 'view', $rattery->id], ['escape' => false]) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('owner_user', $exceptions)): ?>
                        <td><?= $rattery->has('user') ? $this->Html->link(h($rattery->user->username), ['controller' => 'Users', 'action' => 'view', $rattery->user->id], ['escape' => false]) : '' ?></td>
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
                    <?php if (! in_array('website', $exceptions)): ?>
                        <td class="actions">
                            <?= $rattery->website ?
                                $this->Html->image('/img/icon-website.svg', [
                                'url' => h($rattery->website),
                                'class' => 'action-icon',
                                'alt' => __('See Rattery')]) : '' ?>
                        </td>
                    <?php endif; ?>
                    <?php if (! in_array('actions', $exceptions)): ?>
                        <td class="actions">
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
