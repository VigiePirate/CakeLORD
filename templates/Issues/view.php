<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar', isset($help_url) ? $help_url : ['controller' => 'Faqs', 'action' => 'all']) ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Issues', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('List')]) ?>
                        <span class="tooltiptext"><?= __('Back to issue list') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Issues',
                    'object' => $issue,
                    'can_cancel' => false,
                    'user' => $identity
                ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="issues view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Issues') ?></div>
            </div>

            <h1><?= __('Issue #') . $issue->id ?></h1>

            <h2><?= __('Complaint') ?></h2>

            <table class="condensed">
                <tr>
                    <th><?= __('Page') ?></th>
                    <td><?= $this->Html->link(h($issue->url), $this->Url->build($issue->url, ['fullBase' => true]))?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($issue->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('From User') ?></th>
                    <td><?= $this->Html->link($issue->from_user->username, ['controller' => 'Users', 'action' => 'view', $issue->from_user->id]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Comment') ?></th>
                    <td class="comment"><?= $this->Commonmark->sanitize($issue->complaint); ?></td>
            </table>

            <h2><?= __('Handling') ?></h2>
            <?php if ($issue->is_open) : ?>
                <div class="message error">
                    <?= __('This issue has not been handled yet.') ?>
                </div>
            <?php else : ?>
                <table class="condensed">
                    <tr>
                        <th><?= __('Closed') ?></th>
                        <td><?= h($issue->closed) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Handling time') ?></th>
                        <td><?= $issue->closed->timeAgoInWords(['from' => $issue->created, 'accuracy' => ['year' => 'day']]) ?>
                    </tr>
                    <tr>
                        <th><?= __('By User') ?></th>
                        <td><?= $issue->has('closing_user') ? $this->Html->link($issue->from_user->username, ['controller' => 'Users', 'action' => 'view', $issue->from_user->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Comment') ?></th>
                        <td class="comment"><?= $this->Commonmark->sanitize($issue->handling); ?></td>
                    </tr>
                </table>

                <div class="message success">
                    <?= __('This issue is now closed.') ?>
                </div>
            <?php endif ; ?>
        </div>
    </div>
</div>
