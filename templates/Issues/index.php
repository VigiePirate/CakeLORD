<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Issue> $issues
 */
?>
<div class="issues index content">
    <?= $this->Html->link(__('New Issue'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Issues') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('is_open') ?></th>
                    <th><?= $this->Paginator->sort('url') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('closed') ?></th>
                    <th><?= $this->Paginator->sort('from_user_id') ?></th>
                    <th><?= $this->Paginator->sort('closing_user_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($issues as $issue): ?>
                <tr>
                    <td><?= $this->Number->format($issue->id) ?></td>
                    <td><?= h($issue->is_open) ?></td>
                    <td><?= h($issue->url) ?></td>
                    <td><?= h($issue->created) ?></td>
                    <td><?= h($issue->closed) ?></td>
                    <td><?= $this->Number->format($issue->from_user_id) ?></td>
                    <td><?= $issue->has('user') ? $this->Html->link($issue->user->username, ['controller' => 'Users', 'action' => 'view', $issue->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $issue->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $issue->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $issue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $issue->id)]) ?>
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
