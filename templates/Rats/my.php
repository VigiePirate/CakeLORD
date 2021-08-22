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
            <input class="radio" id="five" name="group" type="radio">
            <input class="radio" id="six" name="group" type="radio">
            <div class="tabs">
                <label class="tab" id="one-tab" for="one">
                    <?= $this->Html->image('/img/icon-white-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My colony')]) ?>
                </label>
                <label class="tab" id="two-tab" for="two">
                    <?= $this->Html->image('/img/icon-white-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My females')]) ?>
                </label>
                <label class="tab" id="three-tab" for="three">
                    <?= $this->Html->image('/img/icon-white-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My males')]) ?>
                </label>
                <label class="tab" id="four-tab" for="four">
                    <?= $this->Html->image('/img/icon-white-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My rainbow bridge')]) ?>
                </label>
                <label class="tab" id="five-tab" for="five">
                    <?= $this->Html->image('/img/icon-white-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('Corrections needed')]) ?>
                </label>
                <label class="tab" id="six-tab" for="six">
                    <?= $this->Html->image('/img/icon-white-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('Waiting staff action')]) ?>
                </label>
            </div>
            <div class="panels">
                <div class="panel users content view" id="one-panel">
                    <?= $this->element('rats', [
                        'rubric' => __('My colony'),
                        'rats' => $alive,
                        'exceptions' => [
                            'pup_name',
                            'birth_date',
                            'owner_user_id',
                        ],
                    ]) ?>
                </div>
                <div class="panel" id="two-panel">
                    <div class="panel users content view" id="two-panel">
                        <?= $this->element('rats', [
                            'rubric' => __('My females'),
                            'rats' => $females,
                            'exceptions' => [
                                'pup_name',
                                'birth_date',
                                'owner_user_id',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel" id="three-panel">
                    <div class="panel users content view" id="three-panel">
                        <?= $this->element('rats', [
                            'rubric' => __('My males'),
                            'rats' => $males,
                            'exceptions' => [
                                'pup_name',
                                'birth_date',
                                'owner_user_id',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel" id="four-panel">
                    <div class="panel users content view" id="four-panel">
                        <?= $this->element('rats', [
                            'rubric' => __('My Rainbow Bridge'),
                            'rats' => $departed,
                            'exceptions' => [
                                'pup_name',
                                'birth_date',
                                'owner_user_id',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel" id="five-panel">
                    <div class="panel users content view" id="five-panel">
                        <h2><?= __('Corrections needed') ?></h2>
                            <?= $this->element('rats', [
                                'rubric' => __('Corrections needed'),
                                'rats' => $pending,
                                'exceptions' => [
                                    'pup_name',
                                    'birth_date',
                                    'owner_user_id',
                                ],
                            ]) ?>
                    </div>
                </div>
                <div class="panel" id="six-panel">
                    <div class="panel users content view" id="six-panel">
                        <h2><?= __('Waiting staff action') ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->css('tabs.css') ?>
