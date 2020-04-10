<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <?php if(count($ratteries) == 1): ?>
                <?= count($ratteries) ?>
                <?php $rattery = $ratteries[0] ?>
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
            <?php else: ?>
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
            <?php endif; ?>
        </div>
    </div>
</div>
