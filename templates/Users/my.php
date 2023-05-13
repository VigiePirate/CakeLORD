<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar', ['help_url' => ['controller' => 'Categories', 'action' => 'view', 5]]) ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="users view content">

            <?= $this->Html->link(__('See public profile'), ['controller' => 'Users', 'action' => 'view', $user->id], ['class' => 'button float-right']) ?>
            <?= $this->Html->link(__('Edit profile'), ['controller' => 'Users', 'action' => 'edit', $user->id], ['class' => 'button float-right']) ?>

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->dashboard_title) ?></div>
            </div>

            <h1><?= __('My profile') ?> </h1>
        </div>
        <div class="spacer"></div>
        <div class="users view content">  
            <div class="row row-with-photo">
                <div class="column-responsive column-66">
                    <h2><?= __('Public information') ?></h2>
                    <table class="aside-photo unfold">
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
                <div class="column column-photo edit-photo">
                    <?php if ($user->avatar != '' && $user->avatar != 'Unknown.png') : ?>
                        <?= $this->Html->image(UPLOADS . $user->avatar, ['alt' => $user->username, 'url' => ['action' => 'changePicture', $user->id]]) ?>
                    <?php else : ?>
                        <?= $this->Html->image('UnknownUser.svg', ['url' => ['action' => 'changePicture', $user->id]]) ?>
                    <?php endif; ?>
                </div>
            </div>

            <h2><?= __('About me') ?></h2>
            <div class="text">
                <blockquote>
                    <div class="markdown">
                        <?= $this->Commonmark->sanitize($user->about_me); ?>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="spacer"></div>
        <div class="users view content">
            <h2 class="staff"><?= __('Private information') ?></h2>
            <table class="unfold">
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
                    <th><?= __x('grammar', 'Grammatical Gender') ?></th>
                    <td><?= h($user->sex_string) ?></td>
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
        </div>
        <div class="spacer"></div>
        <div class="users view content">
            <h2 class="staff"><?= __('Settings') ?></h2>
            <table class="unfold">
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
