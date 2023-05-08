<?php if ($rubric != '') : ?>
    <h2><?= h($rubric) ?></h2>
<?php endif; ?>
<div class="table-responsive">
    <table class="condensed">
        <thead>
            <?php if (! in_array('state_id', $exceptions)): ?>
                <th><?= $this->Paginator->sort('state_id','State')?></th>
            <?php endif; ?>
            <?php if (! in_array('picture', $exceptions)): ?>
                <th class="col-head"><?= __('Picture') ?></th>
            <?php endif; ?>
            <?php if (! in_array('pedigree_identifier', $exceptions)): ?>
                <th><?= $this->Paginator->sort('pedigree_identifier','Identifier') ?></th>
            <?php endif; ?>
            <?php if (! in_array('prefix', $exceptions)): ?>
                <th class="col-head"><?= __('Prefix') ?></th>
            <?php endif; ?>
            <?php if (! in_array('name', $exceptions)): ?>
                <th><?= $this->Paginator->sort('name') ?></th>
            <?php endif; ?>
            <?php if (! in_array('pup_name', $exceptions)): ?>
                <th class="hide-on-mobile"><?= $this->Paginator->sort('pup_name') ?></th>
            <?php endif; ?>
            <?php if (! in_array('birth_date', $exceptions)): ?>
                <th><?= $this->Paginator->sort('birth_date', ['label' => __('Birth')]) ?></th>
            <?php endif; ?>
            <?php if (! in_array('age_string', $exceptions)): ?>
                <th class="col-head"><?= __('Reached Age') ?></th>
            <?php endif; ?>
            <?php if (! in_array('death_cause', $exceptions)): ?>
                <th class="col-head"><?= __('Death cause') ?></th>
            <?php endif; ?>
            <?php if (! in_array('owner_user_id', $exceptions)): ?>
                <th><?= $this->Paginator->sort('OwnerUsers.username','Owner') ?></th>
            <?php endif; ?>
            <?php if (! in_array('sex', $exceptions)): ?>
                <th><?= $this->Paginator->sort('sex','Sex') ?></th>
            <?php endif; ?>
            <?php if (! in_array('actions', $exceptions)): ?>
                <th class="actions-title col-head"><?= __('Actions') ?></th>
            <?php endif; ?>
    </thead>
        <tbody>
            <?php foreach($rats as $rat): ?>
                <tr>
                    <?php if (! in_array('state_id', $exceptions)): ?>
                        <td><span class="statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></span></td>
                    <?php endif; ?>
                    <?php if (! in_array('picture', $exceptions)): ?>
                        <td><?= isset($rat->picture_thumbnail) ? $this->Html->image(UPLOADS . $rat->picture_thumbnail, ['alt' => $rat->name]) : '' ?></td>
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
                        <td class="hide-on-mobile"><?= h($rat->pup_name) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('birth_date', $exceptions)): ?>
                        <td><?= h($rat->birth_date->i18nFormat('dd/MM/yyyy')) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('age_string', $exceptions)): ?>
                        <td><?= h($rat->age_string) ?></td>
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
                    <?php if (! in_array('actions', $exceptions)): ?>
                        <td class="actions">
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
                        </td>
                    <?php endif ;?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (! in_array('paginator', $exceptions)): ?>
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
<?php endif; ?>
