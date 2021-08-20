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
                <label class="tab" id="one-tab" for="one"> <?= __('My rats') ?> </label>
                <label class="tab" id="two-tab" for="two"> <?= $this->Html->image("/img/icon-female.svg", ["alt" => "Dashboard", "width" => "40"]) ?> <?= __('My females') ?> </label>
                <label class="tab" id="three-tab" for="three"> <?= __('My males') ?> </label>
            </div>
            <div class="panels">
                <div class="panel users content view" id="one-panel">
                    <?= $this->element('rats', [
                        'rubric' => __(''),
                        'exceptions' => [
                            'pup_name',
                            'birth_date',
                            'owner_user_id',
                        ],
                        ]) ?>
                </div>
                <div class="panel" id="two-panel">
                    <div class="panel users content view" id="two-panel">
                        Females (to be done)
                    </div>
                </div>
                <div class="panel" id="three-panel">
                    <div class="panel users content view" id="three-panel">
                        Males (to be done)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->css('tabs.css') ?>
