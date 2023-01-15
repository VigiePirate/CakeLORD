<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Issue> $issues
 */
?>
<div class="issues index content">
    <?= $this->Html->link(__('See Open Issues'), ['action' => 'index'], ['class' => 'button button-staff float-right']) ?>
    <?= $this->Html->link(__('See All Issues'), ['action' => 'all'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('Closed Issues') ?></h1>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('from_user_id', __('From User')) ?></th>
                    <th><?= $this->Paginator->sort('url', __('URL')) ?></th>
                    <th><?= $this->Paginator->sort('closed') ?></th>
                    <th><?= $this->Paginator->sort('closing_user_id', __('Closing User')) ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($issues as $issue): ?>
                <tr>
                    <td><?= h($issue->created) ?></td>
                    <td><?= $issue->has('from_user') ? $this->Html->link($issue->from_user->username, ['controller' => 'Users', 'action' => 'view', $issue->from_user->id]) : '' ?></td>
                    <td><?= $this->Html->link(h($issue->url), $this->Url->build($issue->url, ['fullBase' => true]))?></td>
                    <td><?= h($issue->closed) ?></td>
                    <td><?= $issue->has('closing_user') ? $this->Html->link($issue->closing_user->username, ['controller' => 'Users', 'action' => 'view', $issue->closing_user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-view.svg', [
                            'url' => ['controller' => 'Issues', 'action' => 'view', $issue->id],
                            'class' => 'action-icon',
                            'alt' => __('View Issue')
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
