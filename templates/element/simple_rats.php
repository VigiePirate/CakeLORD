<?php if ($rubric != '') : ?>
    <h2><?= h($rubric) ?></h2>
<?php endif; ?>

<?php if (empty($rats)) : ?>
    <div class="table-responsive"></div>
<?php else : ?>
    <div class="table-responsive">
        <!-- in tabs, style is that of 'rats' element -->
        <?php if (! in_array('tabs', $exceptions)): ?>
            <table class="summary">
        <?php else: ?>
            <table>
        <?php endif; ?>
            <thead>
                <?php if (! in_array('picture', $exceptions)): ?>
                    <th class="hide-on-mobile"><?= __('Picture') ?></th>
                <?php endif; ?>
                <?php if (! in_array('state_id', $exceptions)): ?>
                    <!-- <th class="hide-on-mobile"><?= __('State') ?></th>
                    <th class="show-on-mobile">&nbsp;</th> -->
                    <th><?= __('State') ?></th>
                <?php endif; ?>
                <?php if (! in_array('pedigree_identifier', $exceptions)): ?>
                    <th><?= __('Identifier') ?></th>
                <?php endif; ?>
                <?php if (! in_array('prefix', $exceptions)): ?>
                    <th class="hide-on-mobile"><?= __('Prefix') ?></th>
                <?php endif; ?>
                <?php if (! in_array('name', $exceptions)): ?>
                    <th><?= __('Name') ?></th>
                <?php endif; ?>
                <?php if (! in_array('pup_name', $exceptions)): ?>
                    <th><?= __('Pup Name') ?></th>
                <?php endif; ?>
                <?php if (! in_array('birth_date', $exceptions)): ?>
                    <th><?= __('Birth') ?></th>
                <?php endif; ?>
                <?php if (! in_array('age_string', $exceptions)): ?>
                    <th><?= __('Age') ?></th>
                <?php endif; ?>
                <?php if (! in_array('death_cause', $exceptions)): ?>
                    <th><?= __('Death cause') ?></th>
                <?php endif; ?>
                <?php if (! in_array('owner_user_id', $exceptions)): ?>
                    <th><?= __('Owner') ?></th>
                <?php endif; ?>
                <?php if (! in_array('sex', $exceptions)): ?>
                    <th class="parent"><?= __('Sex') ?></th>
                <?php endif; ?>
                <?php if (! in_array('actions', $exceptions)): ?>
                    <th class="actions-title hide-on-mobile"><?= __('Actions') ?></th>
                <?php endif; ?>
        </thead>
            <tbody>
                <?php foreach($rats as $rat): ?>
                    <tr>
                        <?php if (! in_array('picture', $exceptions)): ?>
                            <td class="hide-on-mobile"><?= isset($rat->picture_thumbnail) ? $this->Html->image(UPLOADS . $rat->picture_thumbnail, ['alt' => $rat->name]) : '' ?></td>
                        <?php endif; ?>
                        <?php if (! in_array('state_id', $exceptions)): ?>
                            <td><span class="statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></span></td>
                        <?php endif; ?>
                        <?php if (! in_array('pedigree_identifier', $exceptions)): ?>
                            <td><?= $this->Html->link($rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $rat->id]) ?></td>
                        <?php endif; ?>
                        <?php if (! in_array('prefix', $exceptions)): ?>
                            <td class="hide-on-mobile"><span class="nowrap"><?= h($rat->double_prefix) ?></span></td>
                        <?php endif; ?>
                        <?php if (! in_array('name', $exceptions)): ?>
                            <td><?= h($rat->name) ?><sup><?= h($rat->is_alive_symbol) ?></sup></td>
                        <?php endif; ?>
                        <?php if (! in_array('pup_name', $exceptions)): ?>
                            <td><?= h($rat->pup_name) ?></td>
                        <?php endif; ?>
                        <?php if (! in_array('birth_date', $exceptions)): ?>
                            <td><?= h($rat->birth_date->i18nFormat('dd/MM/yyyy')) ?></td>
                        <?php endif; ?>
                        <?php if (! in_array('age_string', $exceptions)): ?>
                            <td class="nowrap"><?= $rat->short_age_string ?></td>
                        <?php endif; ?>
                        <?php if (! in_array('death_cause', $exceptions)): ?>
                            <td><?= h($rat->short_death_cause) ?></td>
                        <?php endif; ?>
                        <?php if (! in_array('owner_user_id', $exceptions)): ?>
                            <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                        <?php endif; ?>
                        <?php if (! in_array('sex', $exceptions)): ?>
                            <td class="parent sexcolor_<?php echo h($rat->sex) ?>"><?= h($rat->sex_symbol) ?></td>
                        <?php endif; ?>
                        <?php if (! in_array('actions', $exceptions)): ?>
                            <td class="actions hide-on-mobile">
                                <span class="nowrap">
                                    <?php if (! is_null($user) && $user->can('edit', $rat)) : ?>
                                        <?= $this->Html->image('/img/icon-edit.svg', [
                                            'url' => ['controller' => 'Rats', 'action' => 'edit', $rat->id],
                                            'class' => 'action-icon',
                                            'alt' => __('Edit Rat')])
                                        ?>
                                    <?php else :?>
                                        <span class="disabled">
                                            <?= $this->Html->image('/img/icon-edit.svg', [
                                                'url' => '',
                                                'class' => 'action-icon disabled',
                                                'alt' => __('Edit Rat')])
                                            ?>
                                        </span>
                                    <?php endif ;?>
                                    <?php if (! is_null($user) && $user->can('microEdit', $rat)) : ?>
                                        <?= $this->Html->image('/img/icon-declare-death.svg', [
                                            'url' => ['controller' => 'Rats', 'action' => 'declare-death', $rat->id],
                                            'class' => 'action-icon',
                                            'alt' => __('Declare Death')])
                                        ?>
                                    <?php else :?>
                                        <span class="disabled">
                                            <?= $this->Html->image('/img/icon-declare-death.svg', [
                                                'url' => '',
                                                'class' => 'action-icon disabled',
                                                'alt' => __('Declare Death')])
                                            ?>
                                        </span>
                                    <?php endif ;?>
                                </span>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif ; ?>
