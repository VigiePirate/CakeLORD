<div class="sheet-heading">
    <h2><?= __('My Notifications') ?></h2>
</div>

<?= $this->Flash->render() ?>

<?php if ($count['sheet_sub_total'] > 0) : ?>
    <div class="message error">
        <?= __('You have <strong>{0, plural, =1 {one sheet} other{# sheets}}</strong> to correct. Please, check rats, litters and ratteries from your sidebar and take action soon.', [$count['sheet_sub_total']]) ?>
    </div>
<?php endif ;?>

<p>
    <?php if ($count['total'] > 0) :?>
        <?=  __('Notifications concern not only your own sheets, but also all the sheets you have rights on.') ?>
        <br/>
        <?= __('Only your most recent notifications are shown below.') ?>
    <?php else : ?>
        <?= __('You haven’t received any notification recently.') ?>
    <?php endif ; ?>
    <?=  __('You can access your notification history from the buttons opposite.') ?>
    <br/>
    <?php if ($count['message_sub_total'] > 0) : ?>
        <?= __('{0, plural, =1 {<strong>One notification</strong> calls for action and is highlighted below} other{<strong># notification</strong> call for action and are highlighted below}}</strong>. Please pay particular attention to {0, plural, =1{it} other{them}}.', [$count['message_sub_total']]) ?>
    <?php endif ; ?>
</p>
<br/>

<div class="hide-on-mobile">
    <div class="button-small">
        <?=
            $this->Html->link(__('All rat notifications'),
                [
                    'controller' => 'RatMessages',
                    'action' => 'my',
                    '?' => [
                        'sort' => 'RatMessages.created',
                        'direction' => 'DESC'
                    ]
                ],
                [
                    'class' => 'button float-right'
                ]
            )
        ?>
    </div>
    <h3 class="shortlist"><?= __('Rats') ?></h3>
    <?php if ($count['rat_total'] == 0) : ?>
        <p><?= __('No recent notification.') ?><p>
    <?php else : ?>
        <div class="table-responsive">
            <table class="summary highlightable">
                <thead>
                    <tr>
                        <th><?= __('State') ?></th>
                        <th><?= __x('message', 'About') ?></th>
                        <th><?= __('Usual name') ?></th>
                        <th><?= __x('message', 'Content') ?></th>
                        <th><?= __x('message', 'Sent by') ?></th>
                        <th><?= __x('message', 'Created') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rat_messages as $ratMessage): ?>
                        <?php if ($ratMessage->rat->state->needs_user_action && in_array($ratMessage->id, $rat_last_messages_ids)) : ?>
                            <tr class="highlight-row">
                        <?php else : ?>
                            <tr>
                        <?php endif ; ?>
                        <td><span class="statecolor_<?php echo h($ratMessage->rat->state_id) ?>"><?= h($ratMessage->rat->state->symbol) ?></span></td>
                            <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?></td>
                            <td><?= h($ratMessage->rat->usual_name) ?></td>
                            <td class="ellipsis" onclick="toggleMessage(this)"><?= nl2br(h($ratMessage->content)) ?></td>

                            <td>
                                <?=
                                    $ratMessage->has('user') && ! $ratMessage->is_automatically_generated
                                    ? h($ratMessage->user->username)
                                    : __('LORD')
                                ?>
                            </td>
                            <td><?= h($ratMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="button-small">
        <?=
            $this->Html->link(__('All rattery notifications'),
                [
                    'controller' => 'RatteryMessages',
                    'action' => 'my',
                    '?' => [
                        'sort' => 'RatteryMessages.created',
                        'direction' => 'DESC'
                    ]
                ],
                [
                    'class' => 'button float-right'
                ]
            )
        ?>
    </div>
    <h3 class="shortlist"><?= __('Ratteries') ?></h3>
    <?php if ($count['rattery_total'] == 0) : ?>
        <p><?= __('No recent notification.') ?></p>
    <?php else : ?>
        <div class="table-responsive">
            <table class="summary highlightable">
                <thead>
                    <tr>
                        <th><?= __('State') ?></th>
                        <th><?= __x('message', 'About') ?></th>
                        <!-- <th><?= __('Staff?') ?></th>
                        <th><?= __('Auto?') ?></th> -->
                        <th><?= __x('message', 'Content') ?></th>

                        <!-- <th class="actions"><?= __('Sheet') ?></th> -->

                        <th><?= __x('message', 'Sent by') ?></th>
                        <th><?= __x('message', 'Created') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rattery_messages as $ratteryMessage): ?>
                        <?php if ($ratteryMessage->rattery->state->needs_user_action && in_array($ratteryMessage->id, $rattery_last_messages_ids)) : ?>
                            <tr class="highlight-row">
                        <?php else : ?>
                            <tr>
                        <?php endif ; ?>
                        <td><span class="statecolor_<?php echo h($ratteryMessage->rattery->state_id) ?>"><?= h($ratteryMessage->rattery->state->symbol) ?></span></td>
                            <td><?= $ratteryMessage->has('rattery') ? $this->Html->link($ratteryMessage->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $ratteryMessage->rattery->id]) : '' ?></td>
                            <td class="ellipsis" onclick="toggleMessage(this)"><?= nl2br(h($ratteryMessage->content)) ?></td>
                            <td>
                                <?=
                                    $ratteryMessage->has('user') && ! $ratteryMessage->is_automatically_generated
                                    ? h($ratteryMessage->user->username)
                                    : __('LORD')
                                ?>
                            </td>
                            <td><?= h($ratteryMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="button-small">
        <?=
            $this->Html->link(__('All litter notifications'),
                [
                    'controller' => 'LitterMessages',
                    'action' => 'my',
                    '?' => [
                        'sort' => 'LitterMessages.created',
                        'direction' => 'DESC'
                    ]
                ],
                [
                    'class' => 'button float-right'
                ]
            )
        ?>
    </div>
    <h3 class="shortlist"><?= __('Litters') ?></h3>
    <?php if ($count['litter_total'] == 0) : ?>
        <p><?= __('No recent notification.') ?></p>
    <?php else : ?>
        <div class="table-responsive">
            <table class="summary highlightable">
                <thead>
                    <tr>
                        <th><?= __('State') ?></th>
                        <th><?= __x('message', 'About') ?></th>
                        <!-- <th><?= __('Staff?') ?></th>
                        <th><?= __('Auto?') ?></th> -->
                        <th><?= __('Parents') ?></th>
                        <th><?= __x('message', 'Content') ?></th>

                        <!-- <th class="actions"><?= __('Sheet') ?></th> -->

                        <th><?= __x('message', 'Sent by') ?></th>
                        <th><?= __x('message', 'Created') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($litter_messages as $litterMessage): ?>
                        <?php if ($litterMessage->litter->state->needs_user_action && in_array($litterMessage->id, $litter_last_messages_ids)) : ?>
                                <tr class="highlight-row">
                        <?php else : ?>
                            <tr>
                        <?php endif ; ?>
                        <td><span class="statecolor_<?php echo h($litterMessage->litter->state_id) ?>"><?= h($litterMessage->litter->state->symbol) ?></span></td>
                            <td><?= $litterMessage->has('litter') ? $this->Html->link($litterMessage->litter->birth_date, ['controller' => 'Litters', 'action' => 'view', $litterMessage->litter->id]) : '' ?></td>
                            <td><?= $litterMessage->has('litter') ? h($litterMessage->litter->parents_name) : '' ?></td>
                            <td class="ellipsis" onclick="toggleMessage(this)"><?= nl2br(h($litterMessage->content)) ?></td>
                            <td>
                                <?=
                                    $litterMessage->has('user') && ! $litterMessage->is_automatically_generated
                                    ? h($litterMessage->user->username)
                                    : __('LORD')
                                ?>
                            </td>
                            <td><?= h($litterMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<div class="show-on-mobile">
    <div class="button-small">
        <?=
            $this->Html->link(__('All rat notifications'),
                [
                    'controller' => 'RatMessages',
                    'action' => 'my',
                    '?' => [
                        'sort' => 'RatMessages.created',
                        'direction' => 'DESC'
                    ]
                ],
                [
                    'class' => 'button float-right'
                ]
            )
        ?>
    </div>
    <h3 class="shortlist"><?= __('Rats') ?></h3>
    <?php if ($count['rat_total'] == 0) : ?>
        <p><?= __('No recent notification.') ?><p>
    <?php else : ?>

        <?php foreach ($rat_messages as $ratMessage): ?>
            <?php if ($ratMessage->rat->state->needs_user_action && in_array($ratMessage->id, $rat_last_messages_ids)) : ?>
                <table class="highlighted notification">
            <?php else : ?>
                <table class="notification">
            <?php endif ; ?>
                <tr>
                    <th>
                        <?=
                            $ratMessage->has('rat')
                            ? $this->Html->link(mb_strimwidth(h($ratMessage->rat->usual_name), 0, 36, '...'), ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id], ['escape' => false])
                            : ''
                        ?>
                    </th>
                    <td>
                        <span class="statecolor_<?php echo h($ratMessage->rat->state_id) ?>"><?= h($ratMessage->rat->state->symbol) ?></span>
                    </td>
                </tr>

                <tr>
                    <th><?= __x('message', 'Created') ?></th>
                    <td><?= h($ratMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                </tr>

                <tr>
                    <th><?= __x('message', 'Sent by') ?></th>
                    <td><?=
                        $ratMessage->has('user') && ! $ratMessage->is_automatically_generated
                        ? h($ratMessage->user->username)
                        : __('LORD')
                    ?></td>
                </tr>

                <tr>
                    <th><?= __('Sheet') ?></th>
                    <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __x('message', 'Content') ?></th>
                    <td><?= mb_strimwidth($ratMessage->content, 0, 256, '...') ?></td>
                </tr>
            </table>
        <?php endforeach ; ?>
    <?php endif; ?>

    <div class="button-small">
        <?=
            $this->Html->link(__('All rattery notifications'),
                [
                    'controller' => 'RatteryMessages',
                    'action' => 'my',
                    '?' => [
                        'sort' => 'RatteryMessages.created',
                        'direction' => 'DESC'
                    ]
                ],
                [
                    'class' => 'button float-right'
                ]
            )
        ?>
    </div>
    <h3 class="shortlist"><?= __('Ratteries') ?></h3>
    <?php if ($count['rattery_total'] == 0) : ?>
        <p><?= __('No recent notification.') ?><p>
    <?php else : ?>

        <?php foreach ($rattery_messages as $ratteryMessage): ?>
            <?php if ($ratteryMessage->rattery->state->needs_user_action && in_array($ratteryMessage->id, $rattery_last_messages_ids)) : ?>
                <table class="highlighted notification">
            <?php else : ?>
                <table class="notification">
            <?php endif ; ?>
                <tr>
                    <th>
                        <?=
                            $ratteryMessage->has('rattery')
                            ? $this->Html->link(mb_strimwidth(h($ratteryMessage->rattery->full_name), 0, 36, '...'), ['controller' => 'Ratteries', 'action' => 'view', $ratteryMessage->rattery->id], ['escape' => false])
                            : ''
                        ?>
                    </th>
                    <td>
                        <span class="statecolor_<?php echo h($ratteryMessage->rattery->state_id) ?>"><?= h($ratteryMessage->rattery->state->symbol) ?></span>
                    </td>
                </tr>

                <tr>
                    <th><?= __x('message', 'Created') ?></th>
                    <td><?= h($ratteryMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                </tr>

                <tr>
                    <th><?= __x('message', 'Sent by') ?></th>
                    <td><?=
                        $ratteryMessage->has('user') && ! $ratteryMessage->is_automatically_generated
                        ? h($ratteryMessage->user->username)
                        : __('LORD')
                    ?></td>
                </tr>

                <tr>
                    <th><?= __('Sheet') ?></th>
                    <td><?= $ratteryMessage->has('rattery') ? $this->Html->link($ratteryMessage->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $ratteryMessage->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __x('message', 'Content') ?></th>
                    <td><?= mb_strimwidth($ratteryMessage->content, 0, 256, '...') ?></td>
                </tr>
            </table>
        <?php endforeach ; ?>
    <?php endif; ?>

    <div class="button-small">
        <?=
            $this->Html->link(__('All litter notifications'),
                [
                    'controller' => 'LitterMessages',
                    'action' => 'my',
                    '?' => [
                        'sort' => 'LitterMessages.created',
                        'direction' => 'DESC'
                    ]
                ],
                [
                    'class' => 'button float-right'
                ]
            )
        ?>
    </div>
    <h3 class="shortlist"><?= __('Litters') ?></h3>
    <?php if ($count['litter_total'] == 0) : ?>
        <p><?= __('No recent notification.') ?><p>
    <?php else : ?>

        <?php foreach ($litter_messages as $litterMessage): ?>
            <?php if ($litterMessage->litter->state->needs_user_action && in_array($litterMessage->id, $litter_last_messages_ids)) : ?>
                <table class="highlighted notification">
            <?php else : ?>
                <table class="notification">
            <?php endif ; ?>
                <tr>
                    <th>
                        <?=
                            $litterMessage->has('litter')
                            ? $this->Html->link(mb_strimwidth(h($litterMessage->litter->full_name), 0, 36, '...'), ['controller' => 'Litters', 'action' => 'view', $litterMessage->litter->id], ['escape' => false])
                            : ''
                        ?>
                    </th>
                    <td>
                        <span class="statecolor_<?php echo h($litterMessage->litter->state_id) ?>"><?= h($litterMessage->litter->state->symbol) ?></span>
                    </td>
                </tr>

                <tr>
                    <th><?= __x('message', 'Created') ?></th>
                    <td><?= h($litterMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                </tr>

                <tr>
                    <th><?= __x('message', 'Sent by') ?></th>
                    <td><?=
                        $litterMessage->has('user') && ! $litterMessage->is_automatically_generated
                        ? h($litterMessage->user->username)
                        : __('LORD')
                    ?></td>
                </tr>

                <tr>
                    <th><?= __('Sheet') ?></th>
                    <td><?= $litterMessage->has('litter') ? $this->Html->link($litterMessage->litter->birth_date, ['controller' => 'Litters', 'action' => 'view', $litterMessage->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __x('message', 'Content') ?></th>
                    <td><?= mb_strimwidth($litterMessage->content, 0, 256, '...') ?></td>
                </tr>
            </table>
        <?php endforeach ; ?>
    <?php endif; ?>
</div>
