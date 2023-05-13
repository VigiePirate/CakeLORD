<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar', ['help_url' => ['controller' => 'Categories', 'action' => 'view', 8]]) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <?= $this->Html->link(__('Simulate Litter'), ['action' => 'simulate'], ['class' => 'button float-right']) ?>
            <?= $this->Html->link(__('New Litter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->dashboard_title) ?></div>
            </div>
            <h1><?= __('My litters') ?> </h1>

        </div>
        <div class="spacer"></div>
        <div class="users view content">  
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
