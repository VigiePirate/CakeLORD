<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">

            <?= $this->Html->link(__('New Rattery'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->username) . '’s dashboard' ?></div>
            </div>
            <h1><?= __('My rattery') ?> </h1>

            <?php foreach($ratteries as $rattery): ?>
                <?= $this->element('card', [
                    'image' => $rattery->picture,
                    'rubric' => h($rattery->prefix),
                    $rattery->prefix => [
                        'Name:' => $rattery->name,
                        'Birth_year:' => $rattery->birth_year,
                        'District:' => $rattery->district,
                        'Zip Code:' => $rattery->zip_code,
                        'Country:' => $rattery->has('country') ? $this->Html->link($rattery->country->name, ['controller' => 'Countries', 'action' => 'view', $rattery->country->id]) : '',
                        'Website:' => $this->Html->link($rattery->website),
                        'Wants Statistics:' => $rattery->wants_statistics ? 'Yes' : 'No',
                    ]
                ]) ?>
            <?php endforeach; ?>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
                <?= $this->element('simple_ratteries', [
                    'rubric' => __('Closed Ratteries'),
                    'ratteries' => $closed_ratteries,
                    'exceptions' => [
                        'picture',
                        'owner_user',
                        'country',
                    ],
                ]) ?>
        </div>

    </div>
</div>
