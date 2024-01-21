<?php if ($count['recently_solved_issues'] + $count['open_issues']) :?>
    <div class="issues view content">

        <div class="hide-on-mobile">
            <div class="button-small">
                <?= $this->Html->link(__('See All Issues'), ['controller' => 'issues', 'action' => 'all'], ['class' => 'button button-small float-right']) ?>
            </div>

            <h2><?= __('My Issues') ?></h2>

            <?php if ($count['recently_solved_issues']) :?>
                <h3 class="shortlist"><?= __('Recently solved') ?> </h3>

                <div class="table-responsive">
                    <table class="summary">
                        <thead>
                            <tr>
                                <th><?= __x('issue', 'Created') ?></th>
                                <th><?= __('URL') ?></th>
                                <th><?= __('Handling') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recently_solved_issues as $issue): ?>
                            <tr>
                                <td><?= h($issue->created->i18nFormat('dd/MM/yyyy')) ?></td>
                                <td><?= $this->Html->link(h($issue->url), $this->Url->build($issue->url, ['fullBase' => true]))?></td>
                                <td class="ellipsis" onclick="toggleMessage(this)"><?= h($issue->handling) ?></td>
                                <td class="actions">
                                    <?= $this->Html->image('/img/icon-view.svg', [
                                        'url' => ['controller' => 'Issues', 'action' => 'view', $issue->id],
                                        'class' => 'action-icon',
                                        'alt' => __('Manage Issue')
                                    ])?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php endif ; ?>

            <?php if ($count['open_issues']) :?>
                <h3 class="shortlist"><?= __('Under review') ?> </h3>

                <div class="table-responsive">
                    <table class="summary">
                        <thead>
                            <tr>
                                <th><?= __x('issue', 'Created') ?></th>
                                <th><?= __('URL') ?></th>
                                <th><?= __('Complaint') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($open_issues as $issue): ?>
                            <tr>
                                <td><?= h($issue->created->i18nFormat('dd/MM/yyyy')) ?></td>
                                <td><?= $this->Html->link(h($issue->url), $this->Url->build($issue->url, ['fullBase' => true]))?></td>
                                <td class="ellipsis" onclick="toggleMessage(this)"><?= h($issue->complaint) ?></td>
                                <td class="actions">
                                    <?= $this->Html->image('/img/icon-view.svg', [
                                        'url' => ['controller' => 'Issues', 'action' => 'view', $issue->id],
                                        'class' => 'action-icon',
                                        'alt' => __('Manage Issue')
                                    ])?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php endif ; ?>
        </div>

        <div class="show-on-mobile">
            <div class="button-small">
                <?= $this->Html->link(__('See All Issues'), ['controller' => 'issues', 'action' => 'all'], ['class' => 'button button-small float-right']) ?>
            </div>

            <h2><?= __('My Issues') ?></h2>

            <?php if ($count['recently_solved_issues']) :?>
                <h3 class="shortlist"><?= __('Recently solved') ?> </h3>
                <?php foreach ($recently_solved_issues as $issue): ?>
                    <table class="notification">
                        <tr>
                            <th>
                                <?=
                                    $issue->has('url')
                                    ? $this->Html->link(h($issue->created->i18nFormat('dd/MM/yyyy')) . ' – ' . h($issue->url), $this->Url->build($issue->url, ['fullBase' => true]))
                                    : ''
                                ?>
                            </th>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <th><?= __('Closed') ?></th>
                            <td><?= h($issue->closed) ?> <?= __('(handling time: {0})', $issue->closed->timeAgoInWords(['from' => $issue->created, 'accuracy' => ['year' => 'day']])) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Complaint') ?></th>
                            <td class="comment"><?= $this->Commonmark->sanitize($issue->complaint) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Handling') ?></th>
                            <td class="comment"><?= $this->Commonmark->sanitize($issue->handling) ?></td>
                        </tr>
                    </table>
                <?php endforeach ; ?>
            <?php endif ; ?>

            <?php if ($count['open_issues']) :?>
                <h3 class="shortlist"><?= __('Under review') ?> </h3>
                <?php foreach ($open_issues as $issue): ?>
                    <table class="notification">
                        <tr>
                            <th>
                                <?=
                                    $issue->has('url')
                                    ? $this->Html->link(h($issue->created->i18nFormat('dd/MM/yyyy')) . ' – ' . h($issue->url), $this->Url->build($issue->url, ['fullBase' => true]))
                                    : ''
                                ?>
                            </th>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <th><?= __('Complaint') ?></th>
                            <td class="comment"><?= $this->Commonmark->sanitize($issue->complaint) ?></td>
                        </tr>
                    </table>
                <?php endforeach ; ?>
            <?php endif ; ?>

        </div>

    </div>

    <div class="spacer"> </div>

<?php endif ; ?>
