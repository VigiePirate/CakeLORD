<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\litterMessage> $litterMessages
 */
?>

<?php $this->assign('title', __('Litter Messages')) ?>

<div class="litterMessages index content">
    <h1><?= __('Litter Messages History') ?></h1>
    <div class="table-responsive">
        <table class="summary highlightable">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('created', __x('message', 'Created')) ?></th>
                    <th><?= $this->Paginator->sort('from_user_id', __x('message', 'Sent by')) ?></th>
                    <th><?= $this->Paginator->sort('birth_date', __x('message', 'About')) ?></th>
                    <th class="col-head"><?= __('Parents') ?></th>
                    <th class="col-head"><?= __x('message', 'Content') ?></th>
                    <th><?= $this->Paginator->sort('is_staff_request', __('Staff?')) ?></th>
                    <th><?= $this->Paginator->sort('is_automatically_genelittered', __('Auto?')) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($litterMessages as $litterMessage): ?>
                    <?php if (
                                $litterMessage->litter->state->needs_user_action
                                && $litterMessage->is_staff_request
                                && ! $litterMessage->is_automatically_genelittered
                                && count($litterMessage->litter->litter_messages) != 0
                                && $litterMessage->id == $litterMessage->litter->litter_messages[0]->id
                            ) :
                    ?>
                        <tr class="highlight-row">
                    <?php else : ?>
                        <tr>
                    <?php endif; ?>

                    <td><?= h($litterMessage->created) ?></td>
                    <td><?= $litterMessage->has('user') ? h($litterMessage->user->username) : '' ?></td>
                    <td><?= $litterMessage->has('litter') ? $this->Html->link($litterMessage->litter->birth_date, ['controller' => 'litters', 'action' => 'view', $litterMessage->litter->id]) : '' ?></td>
                    <td><?= $litterMessage->has('litter') ? h($litterMessage->litter->parents_name) : '' ?></td>
                    <td><?= mb_strimwidth($litterMessage->content, 0, 128, '...') ?></td>
                    <td><?= $litterMessage->is_staff_request ? '✓' : '' ?></td>
                    <td><?= $litterMessage->is_automatically_generated ? '✓' : '' ?></td>
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
