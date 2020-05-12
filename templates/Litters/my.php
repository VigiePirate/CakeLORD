<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
                <?= $this->element('litters', [
                    'rubric' => __('My Litters'),
                    'litters' => $litters,
                    'exceptions' => [
                    ],
                ]) ?>
        </div>

    </div>
</div>
