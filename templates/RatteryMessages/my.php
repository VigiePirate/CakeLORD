<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ratteryMessage> $ratteryMessages
 */
?>

<?php $this->assign('title', __('Rattery Messages')) ?>

<div class="ratteryMessages index content">
    <h1><?= __('Rattery Messages History') ?></h1>
    <div class="table-responsive">
        <table class="summary highlightable">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('created', __x('message', 'Created')) ?></th>
                    <th><?= $this->Paginator->sort('Users.username', __x('message', 'Sent by')) ?></th>
                    <th><?= $this->Paginator->sort('Ratteries.prefix', __x('message', 'About')) ?></th>
                    <th class="col-head"><?= __x('message', 'Content') ?></th>
                    <th><?= $this->Paginator->sort('is_staff_request', __('Staff?')) ?></th>
                    <th><?= $this->Paginator->sort('is_automatically_generated', __('Auto?')) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratteryMessages as $ratteryMessage): ?>
                    <tr>
                        <td><?= h($ratteryMessage->created) ?></td>
                        <td><?= $ratteryMessage->has('user') ? h($ratteryMessage->user->username) : '' ?></td>
                        <td><?= $ratteryMessage->has('rattery') ? $this->Html->link($ratteryMessage->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $ratteryMessage->rattery->id]) : '' ?></td>
                        <td><?= mb_strimwidth($ratteryMessage->content, 0, 64, '...') ?></td>
                        <td><?= $ratteryMessage->is_staff_request ? '✓' : '' ?></td>
                        <td><?= $ratteryMessage->is_automatically_generated ? '✓' : '' ?></td>
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
