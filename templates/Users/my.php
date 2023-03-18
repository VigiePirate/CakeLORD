<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="users view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->username) . '’s dashboard' ?></div>
            </div>

            <h1><?= __('My profile') ?> </h1>

            <div class="row row-with-photo">
                <div class="column-responsive column-66">
                    <h2><?= __('Public information') ?></h2>
                    <table class="aside-photo">
                        <tr>
                            <th><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Role') ?></th>
                            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Localization') ?></th>
                            <td><?= h($user->localization) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Main rattery') ?></th>
                            <td><?= h($user->main_rattery_name) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="column column-photo edit-photo column-portrait">
                    <?php if ($user->avatar != '' && $user->avatar != 'Unknown.png') : ?>
                        <?= $this->Html->image(UPLOADS . $user->avatar, ['alt' => $user->username, 'url' => ['action' => 'changePicture', $user->id]]) ?>
                    <?php else : ?>
                        <?= $this->Html->image('UnknownUser.svg', ['url' => ['action' => 'changePicture', $user->id]]) ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="button-small">
                <?= $this->Html->link(__('See public profile'), ['controller' => 'Users', 'action' => 'view', $user->id], ['class' => 'button float-right']) ?>
            </div>
            <div class="button-small">
                <?= $this->Html->link(__('Edit profile'), ['controller' => 'Users', 'action' => 'edit', $user->id], ['class' => 'button float-right']) ?>
            </div>

            <h2><?= __('About me') ?></h2>
            <div class="text">
                <blockquote>
                    <div class="markdown">
                        <?= $this->Commonmark->sanitize($user->about_me); ?>
                    </div>
                </blockquote>
            </div>


            <h2><?= __('Private information') ?></h2>
            <table class="aside-photo">
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Firstname') ?></th>
                    <td><?= h($user->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lastname') ?></th>
                    <td><?= h($user->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth Date') ?></th>
                    <td><?= h($user->birth_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sex') ?></th>
                    <td><?= h($user->sex) ?></td>
                </tr>
                <tr>
                    <th><?= __('Failed Login Attempts') ?></th>
                    <td><?= $this->Number->format($user->failed_login_attempts) ?></td>
                </tr>
                <tr>
                    <th><?= __('Failed Login Last Date') ?></th>
                    <td><?= h($user->failed_login_last_date) ?></td>
                </tr>
            </table>

            <h2><?= __('Settings') ?></h2>
            <table class="aside-photo">
                <tr>
                    <th><?= __('Wants Newsletter?') ?></th>
                    <td><?=
                        $user->wants_newsletter
                        ? __('Yes') . ' — '. $this->Html->link(__('Unsubscribe'), ['action' => 'switchNewsletter', $user->id])
                        : __('No') . ' — ' . $this->Html->link(__('Subscribe'), ['action' => 'switchNewsletter', $user->id])
                     ?></td>
                </tr>
                <tr>
                    <th><?= __('Credentials') ?></th>
                    <td><?= $this->Html->link(__('Change email'), ['action' => 'changeEmail'])
                    . ' — '
                    . $this->Html->link(__('Change password'), ['action' => 'changePassword']) ?></td>
                </tr>
            </table>


            <!-- <?= $this->element('card', [
                'image' => $user->avatar,
                'rubric' => $user->username,
                $user->username => [
                    'Email:' => h($user->email) . ' (' . ($user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '') . ')',
                    'First Name:' => h($user->firstname),
                    'Last Name:' => h($user->lastname),
                    'Sex:' => $user->sex,
                    'Birth Date:' => $user->birth_date,
                    'Localization:' => h($user->localization),
                    'About Me:' => h($user->about_me),
                    'Wants Newsletter:' => $user->wants_newsletter ? __('Yes') : __('No'),
                ]
            ]) ?> -->
        </div>
    </div>
</div>
