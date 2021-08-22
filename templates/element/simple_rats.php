<?php if ($rubric != '') : ?>
    <h2><?= h($rubric) ?></h2>
<?php endif; ?>
<div class="table-responsive">
    <!-- in tabs, style is that of 'rats' element -->
    <?php if (! in_array('tabs', $exceptions)): ?>
        <table class="summary">
    <?php else: ?>
        <table class="condensed">
    <?php endif; ?>
        <thead>
            <?php if (! in_array('state_id', $exceptions)): ?>
                <th><?= __('State') ?></th>
            <?php endif; ?>
            <?php if (! in_array('picture', $exceptions)): ?>
                <th><?= __('Picture') ?></th>
            <?php endif; ?>
            <?php if (! in_array('pedigree_identifier', $exceptions)): ?>
                <th><?= __('Identifier') ?></th>
            <?php endif; ?>
            <?php if (! in_array('prefix', $exceptions)): ?>
                <th><?= __('Prefix') ?></th>
            <?php endif; ?>
            <?php if (! in_array('name', $exceptions)): ?>
                <th><?= __('Name') ?></th>
            <?php endif; ?>
            <?php if (! in_array('pup_name', $exceptions)): ?>
                <th><?= __('Pup Name') ?></th>
            <?php endif; ?>
            <?php if (! in_array('birth_date', $exceptions)): ?>
                <th><?= __('Birth Date') ?></th>
            <?php endif; ?>
            <?php if (! in_array('age_string', $exceptions)): ?>
                <th><?= __('Age (mo)') ?></th>
            <?php endif; ?>
            <?php if (! in_array('death_cause', $exceptions)): ?>
                <th><?= __('Death Cause') ?></th>
            <?php endif; ?>
            <?php if (! in_array('owner_user_id', $exceptions)): ?>
                <th><?= __('Owner') ?></th>
            <?php endif; ?>
            <?php if (! in_array('sex', $exceptions)): ?>
                <th><?= __('Sex') ?></th>
            <?php endif; ?>
            <th class="actions-title"><?= __('Actions') ?></th>
    </thead>
        <tbody>
            <?php foreach($rats as $rat): ?>
                <tr>
                    <?php if (! in_array('state_id', $exceptions)): ?>
                        <td><span class="statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></span></td>
                    <?php endif; ?>
                    <?php if (! in_array('picture', $exceptions)): ?>
                        <td><?= isset($rat->picture_thumbnail) ? $this->Html->image($rat->picture_thumbnail, ['alt' => $rat->name]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('pedigree_identifier', $exceptions)): ?>
                        <td><?= $this->Html->link($rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $rat->id]) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('prefix', $exceptions)): ?>
                        <td><span class="nowrap"><?= h($rat->double_prefix) ?></span></td>
                    <?php endif; ?>
                    <?php if (! in_array('name', $exceptions)): ?>
                        <td><?= h($rat->name) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('pup_name', $exceptions)): ?>
                        <td><?= h($rat->pup_name) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('birth_date', $exceptions)): ?>
                        <td><?= h($rat->birth_date->i18nFormat('dd/MM/yyyy')) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('age_string', $exceptions)): ?>
                        <td><?= h($rat->age) ?> mo</td>
                    <?php endif; ?>
                    <?php if (! in_array('death_cause', $exceptions)): ?>
                        <td><?= h($rat->short_death_cause) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('owner_user_id', $exceptions)): ?>
                        <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('sex', $exceptions)): ?>
                        <td class="sexcolor_<?php echo h($rat->sex) ?>"><?= h($rat->sex_symbol) ?></td>
                    <?php endif; ?>
                    <td class="actions">
                        <span class="nowrap">
                        <?= $this->Html->image('/img/icon-view.svg', [
                            'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id],
                            'class' => 'action-icon',
                            'alt' => __('See Rat')]) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
