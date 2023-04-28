<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar', ['help_url' => ['controller' => 'Articles', 'action' => 'view', 24]]) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">
            <div class="row row-reverse row-with-avatar">
                <div class="column-responsive column-80">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle">
                            <?= h($user->dashboard_title) ?>
                        </div>
                    </div>
                    <h1><?= __('Welcome!') ?></h1>

                    <p><?= ucfirst($today) . ', ' . $hour ?></p>
                    <p><?= $user->welcome_string ?></p>
                    <p><?= $user->rat_birthday_string ?></p>
                    <p><?= $user->coming_birthday_string ?></p>
                </div>
                <div class="column column-photo">
                    <?php if ($user->avatar != '' && $user->avatar != 'Unknown.png') : ?>
                        <?= $this->Html->image(UPLOADS . $user->avatar, ['alt' => $user->username]) ?>
                    <?php else : ?>
                        <?= $this->Html->image('UnknownUser.svg', ['url' => ['action' => 'changePicture', $user->id]]) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
            <?= $this->element('my/messages') ?>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
            <?= $this->element('my/issues') ?>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
            <?= $this->element('my/statistics') ?>
        </div>
    </div>
</div>
