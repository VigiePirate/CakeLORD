<?php $this->assign('title', __('Back office')) ?>

<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/staffbar') ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="users content view">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->dashboard_title) ?></div>
            </div>
            <h1><?= __('My back office') ?> </h1>
        </div>
        <div class="spacer"> </div>

        <div class="view content">

            <h2><?= __('Sheets needing staff action') ?></h2>

            <div class="button-small">
                <?= $this->Html->link(__('See all pending rats'), ['controller' => 'Rats', 'action' => 'needs_staff'], ['class' => 'button button-staff float-right']) ?>
            </div>
            <h3><?= __('Rats') ?> (<?= $count['rats'] ?>)</h3>
            <?= $this->element('simple_staff_rats') ?>
            <div class="show-on-mobile spacer"></div>

            <div class="button-small">
                <?= $this->Html->link(__('See all pending litters'), ['controller' => 'Litters', 'action' => 'needs_staff'], ['class' => 'button button-staff float-right']) ?>
            </div>
            <h3><?= __('Litters') ?> (<?= $count['litters'] ?>)</h3>
            <?= $this->element('simple_staff_litters', ['identity' => $user]) ?>
            <div class="show-on-mobile spacer"></div>

            <div class="button-small">
                <?= $this->Html->link(__('See all pending ratteries'), ['controller' => 'Ratteries', 'action' => 'needs_staff'], ['class' => 'button button-staff float-right']) ?>
            </div>
            <h3><?= __('Ratteries') ?> (<?= $count['ratteries'] ?>)</h3>
            <?= $this->element('simple_staff_ratteries') ?>

        </div>
        <div class="spacer"> </div>

        <?php if ($user->role->is_staff) : ?>
            <div class="view content">
                <div class="button-small">
                    <?= $this->Html->link(__('See all issues'), ['controller' => 'Issues', 'action' => 'index'], ['class' => 'button button-staff float-right']) ?>
                </div>
                <h2><?= __('Open issues') ?> (<?= $count['issues'] ?>)</h2>

                <?php if ($issues->count()) : ?>
                    <div class="table-responsive">
                        <table class="summary">
                            <thead>
                                <tr>
                                    <th><?= __x('issue', 'Created') ?></th>
                                    <th><?= __('From User') ?></th>
                                    <th><?= __('URL') ?></th>
                                    <th><?= __('Complaint') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($issues as $issue): ?>
                                <tr>
                                    <td><?= h($issue->created) ?></td>
                                    <td><?= $issue->has('from_user') ? $this->Html->link($issue->from_user->username, ['controller' => 'Users', 'action' => 'view', $issue->from_user->id]) : '' ?></td>
                                    <td><?= $this->Html->link(h($issue->url), $this->Url->build($issue->url, ['fullBase' => true]))?></td>
                                    <td class="ellipsis" onclick="toggleMessage(this)"><?= h($issue->complaint) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->image('/img/icon-backoffice.svg', [
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
            <div class="spacer"> </div>
        <?php endif; ?>

        <?php if ($user->role->can_describe || $user->role->can_describe) : ?>
            <div class="spacer"> </div>
            <div class="view content">
                <h2><?= __('Documentation') ?></h2>
                <?php if ($user->role->can_document) : ?>
                    <h3><?= __('Guides') ?></h3>
                    <table class="condensed">
                        <tr>
                            <th><?= $this->Html->link(__('Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></th>
                            <td><?= __('Manage categories') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></th>
                            <td><?= __('Manage articles') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('FAQs'), ['controller' => 'Faqs', 'action' => 'index']) ?></th>
                            <td><?= __('Manage FAQs') ?></td>
                        </tr>
                    </table>
                <?php endif; ?>
                <?php if ($user->role->can_describe) : ?>
                    <h3><?= __('Varieties') ?></h3>
                    <table class="condensed">
                        <tr>
                            <th><?= $this->Html->link(__('Coats'), ['controller' => 'Coats', 'action' => 'index']) ?></th>
                            <td><?= __('Manage coats') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Colors'), ['controller' => 'Colors', 'action' => 'index']) ?></th>
                            <td><?= __('Manage colors') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Dilutions'), ['controller' => 'Dilutions', 'action' => 'index']) ?></th>
                            <td><?= __('Manage eyecolors') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Earsets'), ['controller' => 'Earsets', 'action' => 'index']) ?></th>
                            <td><?= __('Manage ear types') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Eyecolors'), ['controller' => 'Eyecolors', 'action' => 'index']) ?></th>
                            <td><?= __('Manage eyecolors') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Markings'), ['controller' => 'Markings', 'action' => 'index']) ?></th>
                            <td><?= __('Manage markings') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Singularities'), ['controller' => 'Singularities', 'action' => 'index']) ?></th>
                            <td><?= __('Manage singularities') ?></td>
                        </tr>
                    </table>
                    <h3><?= __('Death Causes') ?></h3>
                    <table class="condensed">
                        <tr>
                            <th><?= $this->Html->link(__('Death Categories'), ['controller' => 'DeathPrimaryCauses', 'action' => 'index']) ?></th>
                            <td><?= __('Manage death categories') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Death Causes'), ['controller' => 'DeathSecondaryCauses', 'action' => 'index']) ?></th>
                            <td><?= __('Manage death causes') ?></td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($user->role->is_staff) : ?>
            <div class="spacer"> </div>
            <div class="view content">
                <h2><?= __('Tools') ?></h2>

                <h3><?= __('Messages') ?></h3>
                <table class="condensed">
                    <tr>
                        <th><?= $this->Html->link(__('RatMessages'), ['controller' => 'RatMessages', 'action' => 'index']) ?></th>
                        <td><?= __('Browse, edit or delete rat messages') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('RatteryMessages'), ['controller' => 'RatteryMessages', 'action' => 'index']) ?></th>
                        <td><?= __('Browse, edit or delete rattery messages') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('LitterMessages'), ['controller' => 'LitterMessages', 'action' => 'index']) ?></th>
                        <td><?= __('Browse, edit or delete litter messages') ?></td>
                    </tr>
                </table>

                <h3><?= __('Sheets by state') ?></h3>

                <?= $this->Form->create(
                    null,
                    [
                        'url' => ['controller' => 'Lord', 'action' => 'inState'],
                        'type' => 'post',
                        'method' => 'post',
                    ],
                ); ?>

                <div class="row tight-form">
                    <div class="column-responsive column-25">
                        <?= $this->Form->control('controller', [
                            'label' => '',
                            'type' => 'select',
                            'options' => $sheet_options,
                        ]); ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('state_id', [
                            'label' => '',
                            'type' => 'select',
                            'options' => $state_options,
                        ]); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                    <div class="column-responsive column-25">
                        <?= $this->Form->button(__('Search'), ['class' => 'personal float-right']); ?>
                    </div>
                </div>


                <?php if ($user->role->can_access_personal) : ?>
                    <h3><?= __('Users') ?></h3>

                    <?= $this->Form->create(
                        null,
                        [
                            'url' => ['controller' => 'Users', 'action' => 'private'],
                            'type' => 'post',
                            'method' => 'post',
                        ],
                    ); ?>
                    <div class="row tight-form">
                        <div class="column-responsive column-70">
                            <?= $this->Form->control('personal', [
                                'label' => '',
                                'type' => 'text',
                                'placeholder' => __('Search user by real name or email address...'),
                                'class' => 'placeholder'
                            ]); ?>
                            <?= $this->Form->end(); ?>
                        </div>
                        <div class="column-responsive column-25">
                            <?= $this->Form->button(__('Search'), ['class' => 'personal float-right']); ?>
                        </div>
                    </div>
                <?php endif ; ?>

            </div>
        <?php endif ; ?>

        <?php if ($user->role->can_configure) : ?>
            <div class="spacer"> </div>
            <div class="view content">
                <h2><?= __('Configuration') ?></h2>
                <table class="condensed">
                    <tr>
                        <th><?= $this->Html->link(__('Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></th>
                        <td><?= __('Configure roles and permissions') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('States'), ['controller' => 'States', 'action' => 'index']) ?></th>
                        <td><?= __('Configure states and sheet workflow') ?></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
    <div>
</div>
