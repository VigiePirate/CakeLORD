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
            <?= $this->element('my/user-summary') ?>
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
