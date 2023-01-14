<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Issue> $issues
 */
?>
<div class="issues index content">
    <h1><?= __('All Issues') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('is_open', __('State')) ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('from_user_id') ?></th>
                    <th><?= $this->Paginator->sort('url', __('URL')) ?></th>
                    <th><?= $this->Paginator->sort('closed') ?></th>
                    <th><?= $this->Paginator->sort('closing_user_id') ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($issues as $issue): ?>
                <tr>
                    <td><?= h($issue->is_open) ?></td>
                    <td><?= h($issue->created) ?></td>
                    <td><?= $issue->has('from_user') ? $this->Html->link($issue->from_user->username, ['controller' => 'Users', 'action' => 'view', $issue->from_user->id]) : '' ?></td>
                    <td><?= h($issue->url) ?></td>
                    <td><?= h($issue->closed) ?></td>
                    <td><?= $issue->has('closing_user') ? $this->Html->link($issue->closing_user->username, ['controller' => 'Users', 'action' => 'view', $issue->closing_user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-view.svg', [
                            'url' => ['controller' => 'Articles', 'action' => 'view', $article->id],
                            'class' => 'action-icon',
                            'alt' => __('View Article')
                        ])?>
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
