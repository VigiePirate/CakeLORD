<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">
            <div class="row row-reverse row-with-avatar">
                <div class="column-responsive column-75">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= h($user->username) . '’s dashboard' ?></div>
                    </div>
                    <h1><?= __('Welcome!') ?></h1>

                    <table class="aside-photo">
                        <tr><td>Write something here?</td></tr>
                        <tr><td>(Last/failed connection time?)</td></tr>
                        <tr><td>(Sheets pending correction?)</td></tr>
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
            <?= $this->element('my/statistics') ?>
        </div>
    </div>
</div>
