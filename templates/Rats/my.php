<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
                <?= $this->element('rats', [
                    'rubric' => __('My Rats'),
                    'exceptions' => [
                        'pup_name',
                        'birth_date',
                        'owner_user_id',
                    ],
                ]) ?>
        </div>
    </div>
</div>
