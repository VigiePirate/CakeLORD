<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('tech_sidebar', [
                    'controller' => 'Litters',
                    'object' => $litter,
                    'tooltip' => 'Browse Litter List',
                    'can_cancel' => true,
                    'show_staff' => $show_staff,
                    'user' => $user
                ])
            ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>
            <h1><?=__('Edit litter #') . $litter->id ?></h1>
            <?= $this->Form->setValueSources(['context', 'data'])->create($litter) ?>

            <?= $this->Flash->render() ?>
            <fieldset>
                <legend><?= __('Public information') ?></legend>
                <?= $this->Form->control('mating_date', ['label' => __('Mating date'), 'empty' => true]) ?>

                <div class="row">
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pups_number', ['label' => __('Pups count'), 'name' => 'pups_number']) ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pups_number_stillborn', ['label' => __('Stillborn pups count')]); ?>
                    </div>
                </div>

                <label><?= __('Contributing ratteries') ?></label>

                <p class="helper">
                    <?= __('Please use the dedicated form to <a href="{0}">edit contributing ratteries</a>.', ['action' => 'manageContributions', $litter->id]) ?> <br/>
                </p>

                <?php
                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Comments'),
                        'rows' => '5',
                    ]);
                ?>

                <?php
                    echo $this->Form->control('rattery_id', [
                        'name' => 'rattery_id',
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for rattery ID'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                        'value' => $litter->contributions[0]->rattery_id,
                    ]);

                    for ($k = 0; $k <= count($litter->contributions)-1; $k++) {
                        echo $this->Form->control('contributions.'.$k.'.id', [
                            'type' => 'hidden',
                            'value' => $litter->contributions[$k]->id,
                        ]);
                        echo $this->Form->control('contributions.'.$k.'.contribution_type_id', [
                            'type' => 'hidden',
                            'value' => $litter->contributions[$k]->contribution_type_id,
                        ]);
                        echo $this->Form->control('contributions.'.$k.'.rattery_id', [
                            'type' => 'hidden',
                            'value' => $litter->contributions[$k]->rattery_id,
                        ]);
                        echo $this->Form->control('contributions.'.$k.'.litter_id', [
                            'type' => 'hidden',
                            'value' => $litter->contributions[$k]->litter_id,
                        ]);
                    }
                ?>

                <?php if ($user->can('staffEdit', $litter)) : ?>
                    <h2 class="staff"><?= __('Staff-only') ?></h2>

                    <?= $this->Form->control('birth_date') ?>

                    <div class="row">
                        <div class="column-responsive column-50">
                            <?php
                                echo $this->Form->control('mother_name', [
                                    'id' => 'jquery-mother-input',
                                    'name' => 'mother_name',
                                    'label' => __('Mother'),
                                    'value' => $mother->form_name,
                                ]);
                                echo $this->Form->control('mother_id', [
                                    'id' => 'jquery-mother-id',
                                    'name' => 'mother_id',
                                    'label' => [
                                        'class' => 'hide-everywhere',
                                        'text' => 'Hidden field for mother ID'
                                    ],
                                    'class' => 'hide-everywhere',
                                    'type' => 'text',
                                    'value' => $mother->id,
                                ]);
                            ?>
                        </div>
                        <div class="column-responsive column-50">
                            <?php
                                    echo $this->Form->control('father_name', [
                                        'id' => 'jquery-father-input',
                                        'name' => 'father_name',
                                        'label' => __('Father'),
                                        'value' => ! is_null($father) ? $father->form_name : null,
                                    ]);
                                    echo $this->Form->control('father_id', [
                                        'id' => 'jquery-father-id',
                                        'name' => 'father_id',
                                        'label' => [
                                            'class' => 'hide-everywhere',
                                            'text' => 'Hidden field for father ID'
                                        ],
                                        'class' => 'hide-everywhere',
                                        'type' => 'text',
                                        'value' => ! is_null($father) ? $father->id : null,
                                    ]);
                                ?>
                        </div>
                    </div>
                <?php endif ; ?>

                <legend><?= __('Private information') ?></legend>
                <?=
                    $this->element('side_message_control', [
                        'user' => $user,
                        'sheet' => $litter,
                        'required' => false,
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->css('jquery.ui.css') ?>
<?= $this->Html->css('ajax.css') ?>
<?= $this->Html->css('selectize.milligram.css') ?>

<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('jquery.ui.min.js') ?>
<?= $this->Html->script('litter.js') ?>

<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<?= $this->Html->script('easymde.min.js') ?>
<?= $this->Html->script('easymde-light.js') ?>
