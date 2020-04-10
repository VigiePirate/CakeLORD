<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
                <?= $this->element('my/pack', [
                    'rubric' => __('My Rats'),
                ]) ?>
        </div>
    </div>
</div>
