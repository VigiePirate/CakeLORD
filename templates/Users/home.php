<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle">User Dashboard</div>
            </div>
            <?= $this->element('my/user-summary') ?>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
            <div class="related">
                <?= $this->element('my/messages') ?>
            </div>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
            <div class="related">
                <?= $this->element('my/statistics') ?>
            </div>
        </div>
    </div>
</div>
