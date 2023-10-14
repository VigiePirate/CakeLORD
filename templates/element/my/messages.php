<div class="sheet-heading">
    <h2><?= __('My Messages') ?></h2>

    <div class="button-small">
        <?= $this->Html->link(__('See All Messages'), ['controller' => 'Users', 'action' => 'seeMessages'], ['class' => 'button float-right']) ?>
    </div>
</div>

<?= $this->Flash->render() ?>

<p>
    <?= __('{0, plural, =0{You haven’t received any message} =1{You have received <strong>one</strong> message} other{You have received <strong>#</strong> messages}} since your last actions.', [$total]) ?>
    <br/>
    <?php if ($total > 0) : ?>
        <?= __('Messages requiring action are highlighted in red. Please pay attention to them and take action as soon as possible.') ?>
    <?php endif ; ?>
</p>

<?php if (! empty($rat_messages)) : ?>
    <h3><?= __('Rats') ?></h3>
    <div class="table-responsive">
        <table class="summary highlightable">
            <thead>
                <tr>

                    <th><?= __x('message', 'Created') ?></th>
                    <th><?= __x('message', 'Sent by') ?></th>
                    <th><?= __('Identifier') ?></th>
                    <th><?= __('Usual name') ?></th>
                    <!-- <th><?= __('Staff?') ?></th>
                    <th><?= __('Auto?') ?></th> -->
                    <th><?= __('Content') ?></th>
                    <th><?= __('State') ?></th>
                    <!-- <th class="actions"><?= __('Sheet') ?></th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rat_messages as $ratMessage): ?>
                <?php if (
                            $ratMessage->rat->state->needs_user_action
                            && $ratMessage->is_staff_request
                            && ! $ratMessage->is_automatically_generated
                        ) : ?>
                    <tr class="highlight-row">
                <?php else : ?>
                    <tr>
                <?php endif; ?>
                    <td><?= h($ratMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td><?= $ratMessage->has('user') ? $this->Html->link($ratMessage->user->username, ['controller' => 'Users', 'action' => 'view', $ratMessage->user->id]) : '' ?></td>
                    <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?></td>
                    <td><?= h($ratMessage->rat->usual_name) ?></td>
                        <!-- <td><?= $ratMessage->is_staff_request ? '✓' : '' ?></td>
                    <td><?= $ratMessage->is_automatically_generated ? '✓' : '' ?></td> -->
                    <td><?= mb_strimwidth($ratMessage->content, 0, 256, '...') ?></td>
                    <td><span class="statecolor_<?php echo h($ratMessage->rat->state_id) ?>"><?= h($ratMessage->rat->state->symbol) ?></span></td>

                    <!-- <td class="actions">
                        <?= $this->Html->image('/img/icon-rat.svg', [
                            'url' => ['controller' => 'Ratteries', 'action' => 'view', $ratMessage->rat->id],
                            'class' => 'action-icon',
                            'alt' => __('See Rat')])
                        ?>
                    </td> -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
