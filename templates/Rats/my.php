<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>

    <div class="column-responsive column-90">

        <div class="users content view" id="one-panel">
            <?= $this->Html->link(__('New Rat'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('{0}’s dashboard', [h($user->username)]) ?></div>
            </div>
            <h1><?= __('My rats') ?> </h1>

            <?= $this->Flash->render(); ?>

        </div>

        <div class="spacer"> </div>
        <div class="tab-wrapper">
            <input class="radio" id="one" name="group" type="radio" checked>
            <input class="radio" id="two" name="group" type="radio">
            <input class="radio" id="three" name="group" type="radio">
            <input class="radio" id="four" name="group" type="radio">
            <input class="radio" id="five" name="group" type="radio">
            <input class="radio" id="six" name="group" type="radio">
            <input class="radio" id="seven" name="group" type="radio">

            <div class="tabs">
                <label class="tab" id="one-tab" for="one">
                    <?= $this->Html->image('/img/icon-white-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('My current colony')]) ?>
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
                <label class="tab" id="seven-tab" for="seven">
                    <?= $this->Html->image('/img/icon-white-rat.svg', [
                        'class' => 'tab-icon',
                        'alt' => __('All my validated rats')]) ?>
                </label>
            </div>
            <div class="noshadow">
            </div>
            <div class="panels">
                <div class="panel users content view" id="one-panel">
                    <?= $this->element('simple_rats', [
                        'rubric' => __('My current colony'),
                        'rats' => $alive,
                        'exceptions' => [
                            'tabs',
                            'pup_name',
                            'birth_date',
                            'owner_user_id',
                        ],
                    ]) ?>
                </div>
                <div class="panel" id="two-panel">
                    <div class="panel users content view" id="two-panel">
                        <?= $this->element('simple_rats', [
                            'rubric' => __('My females'),
                            'rats' => $females,
                            'exceptions' => [
                                'tabs',
                                'pup_name',
                                'birth_date',
                                'owner_user_id',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel" id="three-panel">
                    <div class="panel users content view" id="three-panel">
                        <?= $this->element('simple_rats', [
                            'rubric' => __('My males'),
                            'rats' => $males,
                            'exceptions' => [
                                'tabs',
                                'pup_name',
                                'birth_date',
                                'owner_user_id',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel" id="four-panel">
                    <div class="panel users content view" id="four-panel">
                        <?= $this->element('simple_rats', [
                            'rubric' => __('My Rainbow Bridge'),
                            'rats' => $departed,
                            'exceptions' => [
                                'tabs',
                                'pup_name',
                                'birth_date',
                                'owner_user_id',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel" id="five-panel">
                    <div class="panel users content view" id="five-panel">
                        <?= $this->element('simple_rats', [
                            'rubric' => __('Corrections needed'),
                            'rats' => $pending,
                            'exceptions' => [
                                'tabs',
                                'pup_name',
                                'birth_date',
                                'owner_user_id',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel" id="six-panel">
                    <div class="panel users content view" id="six-panel">
                        <?= $this->element('simple_rats', [
                            'rubric' => __('Waiting staff action'),
                            'rats' => $waiting,
                            'exceptions' => [
                                'tabs',
                                'pup_name',
                                'birth_date',
                                'owner_user_id',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel" id="seven-panel">
                    <div class="panel users content view" id="seven-panel">
                        <?= $this->element('simple_rats', [
                            'rubric' => __('All my validated rats'),
                            'rats' => $okrats,
                            'exceptions' => [
                                'tabs',
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
</div>

<?= $this->Html->css('tabs.css') ?>
