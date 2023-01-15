<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">
            <div class="row row-reverse row-with-avatar">
                <div class="column-responsive column-80">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= h($user->username) . '’s dashboard' ?></div>
                    </div>
                    <h1><?= __('Welcome!') ?></h1>

                    <table>
                        <tr><td><?= ucfirst($today) ?></td></tr>
                        <tr><td><?= $user->welcome_string ?></td></tr>
                        <tr><td><?= $user->rat_birthday_string ?></td></tr>
                        <tr><td><?= $user->coming_birthday_string ?></td></tr>
                    </table>

                </div>
                <div class="column footer-center column-portrait">
                    <?php if ($user->avatar != '') : ?>
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
