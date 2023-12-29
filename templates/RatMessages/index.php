<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RatMessage> $ratMessages
 */
?>
<div class="ratMessages index content">
    <h1><?= __('Rat Messages') ?></h1>
    <div class="table-responsive">
        <table class="summary">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('created', __x('message', 'Created')) ?></th>
                    <th><?= $this->Paginator->sort('pedigree_identifier', __('Identifier')) ?></th>
                    <th class="col-head"><?= __('Usual name') ?></th>
                    <th><?= $this->Paginator->sort('from_user_id', __x('message', 'Sent by')) ?></th>

                    <th><?= $this->Paginator->sort('is_staff_request', __('Staff?')) ?></th>
                    <th><?= $this->Paginator->sort('is_automatically_generated', __('Auto?')) ?></th>
                    <th class="col-head"><?= __('Content') ?></th>
                    <th class="actions col-head"><?= __('Sheet') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratMessages as $ratMessage): ?>

                <?php if (
                            $ratMessage->rat->state->needs_user_action
                            && $ratMessage->is_staff_request
                            && ! $ratMessage->is_automatically_generated
                            && count($ratMessage->rat->rat_messages) != 0
                            && $ratMessage->id == $ratMessage->rat->rat_messages[0]->id
                        ) : ?>
                    <tr class="highlight-row">
                <?php else : ?>
                    <tr>
                <?php endif; ?>

                    <td><?= h($ratMessage->created) ?></td>
                    <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?></td>
                    <td><?= h($ratMessage->rat->usual_name) ?></td>
                    <td><?= $ratMessage->has('user') ? $this->Html->link($ratMessage->user->username, ['controller' => 'Users', 'action' => 'view', $ratMessage->user->id]) : '' ?></td>

                    <td><?= $ratMessage->is_staff_request ? '✓' : '' ?></td>
                    <td><?= $ratMessage->is_automatically_generated ? '✓' : '' ?></td>
                    <td><?= mb_strimwidth($ratMessage->content, 0, 64, '...') ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-rat.svg', [
                            'url' => ['controller' => 'Ratteries', 'action' => 'view', $ratMessage->rat->id],
                            'class' => 'action-icon',
                            'alt' => __('See Rat')])
                        ?>
                    </td>
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
</div>
