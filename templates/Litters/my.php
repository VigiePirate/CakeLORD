<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <?= $this->Html->link(__('Simulate Litter'), ['action' => 'simulate'], ['class' => 'button float-right']) ?>
            <?= $this->Html->link(__('New Litter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->username) . '’s dashboard' ?></div>
            </div>
            <h1><?= __('My litters') ?> </h1>
            <?= $this->element('litters', [
                'rubric' => '',
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
