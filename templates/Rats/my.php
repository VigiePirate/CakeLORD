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
            <input class="radio" id="four" name="group" type="radio">
            <div class="tabs">
                <label class="tab" id="one-tab" for="one">
                    <?= $this->Html->image('/img/icon-black-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My rats'),
                        "width" => "36"]) ?>
                </label>
                <label class="tab" id="two-tab" for="two">
                    <?= $this->Html->image('/img/icon-black-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My females'),
                        "width" => "36"]) ?>
                </label>
                <label class="tab" id="three-tab" for="three">
                    <?= $this->Html->image('/img/icon-black-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My males'),
                        "width" => "36"]) ?>
                </label>
                <label class="tab" id="four-tab" for="four">
                    <?= $this->Html->image('/img/icon-black-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My lost'),
                        "width" => "36"]) ?>
                </label>
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
                <div class="panel" id="four-panel">
                    <div class="panel users content view" id="four-panel">
                        Lost (to be done)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->css('tabs.css') ?>
