<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">
                <?= $this->element('litters', [
                    'rubric' => __('My Litters'),
                    'litters' => $litters,
                    'exceptions' => [
                        'mating_date',
                        'full_name',
                        'pups_number_stillborn',
                    ],
                ]) ?>
        </div>
    </div>
</div>
