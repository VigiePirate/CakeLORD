<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="tab-wrapper">
            <input class="radio" id="one" name="group" type="radio" checked>
            <input class="radio" id="two" name="group" type="radio">
            <input class="radio" id="three" name="group" type="radio">
            <div class="tabs">
                <label class="tab" id="one-tab" for="one"><?= __('All my rats') ?></label>
                <label class="tab" id="two-tab" for="two"><?= __('My females') ?></label>
                <label class="tab" id="three-tab" for="three"><?= __('My males') ?></label>
            </div>
        </div>
        <div class="panels">
            <div class="panel" id="one-panel">
                <div class= "users view content">
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
            <div class="panel" id="two-panel">
                <div class= "users view content">
                    <?= $this->element('rats', [
                        'rubric' => __('My Females'),
                        'exceptions' => [
                            'pup_name',
                            'birth_date',
                            'owner_user_id',
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="panel" id="three-panel">
                <div class= "users view content">
                    <?= $this->element('rats', [
                        'rubric' => __('My Males'),
                        'exceptions' => [
                            'pup_name',
                            'birth_date',
                            'owner_user_id',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->css('tabs.css') ?>
