<div class="sheet-heading">
    <h2><?= __('My Notifications') ?></h2>

    <div class="button-small">
        <?= $this->Html->link(__('All Notifications'), ['controller' => 'Users', 'action' => 'messages'], ['class' => 'button float-right']) ?>
    </div>
</div>

<?= $this->Flash->render() ?>

<p>
    <?php if ($total > 0) :?>
        <?= __('Only your most recent notifications are shown below.') ?>
    <?php else : ?>
        <?= __('You haven’t received any notification recently.') ?>
    <?php endif ; ?>
    <?=  __('You can access your notification history from the button opposite.') ?>
    <br/>
    <?php if ($sub_total > 0) : ?>
        <?= __('{0, plural, =1 {<strong>One notification</strong> calls for action and is highlighted below} other{<strong># notification</strong> call for action and are highlighted below}}</strong>. Please pay particular attention to {0, plural, =1{it} other{them}}.', [$sub_total]) ?>
    <?php endif ; ?>
</p>


<?php if ($total > 0) : ?>
    <br/>
    <div class="table-responsive">
        <table class="summary highlightable">
            <thead>
                <tr>
                    <th><?= __('State') ?></th>
                    <th><?= __x('message', 'About') ?></th>
                    <th><?= __('Usual name') ?></th>
                    <!-- <th><?= __('Staff?') ?></th>
                    <th><?= __('Auto?') ?></th> -->
                    <th><?= __('Message') ?></th>

                    <!-- <th class="actions"><?= __('Sheet') ?></th> -->

                    <th><?= __x('message', 'Sent by') ?></th>
                    <th><?= __x('message', 'Created') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rat_messages as $ratMessage): ?>
                    <?php if ($ratMessage->id == $ratMessage->rat->rat_messages[0]->id) : ?> <!-- FIXME: getting the most recent message for each rat should be made earlier -->
                        <?php if (
                                    $ratMessage->rat->state->needs_user_action
                                    && $ratMessage->is_staff_request
                                    && ! $ratMessage->is_automatically_generated
                                ) : ?>
                            <tr class="highlight-row">
                        <?php else : ?>
                            <tr>
                        <?php endif ; ?>
                        <td><span class="statecolor_<?php echo h($ratMessage->rat->state_id) ?>"><?= h($ratMessage->rat->state->symbol) ?></span></td>
                            <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?></td>
                            <td><?= h($ratMessage->rat->usual_name) ?></td>
                                <!-- <td><?= $ratMessage->is_staff_request ? '✓' : '' ?></td>
                            <td><?= $ratMessage->is_automatically_generated ? '✓' : '' ?></td> -->
                            <td><?= mb_strimwidth($ratMessage->content, 0, 256, '...') ?></td>
                            <!-- <td><span class="statecolor_<?php echo h($ratMessage->rat->state_id) ?>"><?= h($ratMessage->rat->state->symbol) ?></span></td> -->

                            <!-- <td class="actions">
                                <?= $this->Html->image('/img/icon-rat.svg', [
                                    'url' => ['controller' => 'Ratteries', 'action' => 'view', $ratMessage->rat->id],
                                    'class' => 'action-icon',
                                    'alt' => __('See Rat')])
                                ?>
                            </td> -->

                            <td>
                                <?=
                                    $ratMessage->has('user') && ! $ratMessage->is_automatically_generated
                                    ? h($ratMessage->user->username)
                                    : __('LORD')
                                ?>
                            </td>
                            <td><?= h($ratMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                        </tr>
                    <?php endif ; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
