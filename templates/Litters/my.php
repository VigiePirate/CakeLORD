<?php $this->assign('title', __('My litters')) ?>

<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar', ['help_url' => ['controller' => 'Categories', 'action' => 'view', 8]]) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <div class="title-with-button">
                <div>
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= h($user->dashboard_title) ?></div>
                        <div class="button-dashboard">
                            <?= $this->Html->link(__('New Litter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
                        </div>
                    </div>
                    <h1><?= __('My litters') ?> </h1>
                    <?= $this->Flash->render() ?>
                </div>
            </div>

        </div>
        <div class="spacer"></div>
        <div class="users view content">

            <div class="button-small">
                <?= $this->Html->link(__('Simulate Litter'), ['action' => 'simulate'], ['class' => 'button float-right']) ?>
            </div>
            <?= $this->element('litters', [
                'rubric' => __('All my past litters'),
                'litters' => $litters,
                'exceptions' => [
                    'mating_date',
                    'full_name',
                    //'dam', 'sire', 'birth_date',
                    'pups_number_stillborn',
                    'actions'
                ],
            ]) ?>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
