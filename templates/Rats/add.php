<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->assign('title', __('Add rat')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar', ['help_url' => ['controller' => 'Articles', 'action' => 'view', 25]]) ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => 'javascript:history.back()',
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Back') ?></span>
                    </div>
            </div>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Rats') ?></div>
            </div>
            <h1><?=__('Record a new rat') ?></h1>

            <?= $this->Flash->render() ?>

            <?= $this->Form->setValueSources(['context', 'data'])->create($rat, ['type' => 'file']) ?>
            <fieldset>
                <?php if (! $from_litter): ?>
                    <legend><?= __('Origins') ?></legend>
                    <div class="row row-reverse">
                        <div class="column-responsive column-50">
                            <?php
                                echo $this->Form->control('generic_rattery_id', [
                                    'id' => 'generic-rattery-input',
                                    'name' => 'generic_rattery_id',
                                    'label' => __('Birth place or origin'),
                                    'type' => 'radio',
                                    'options' => $origins,
                                    'empty' => false,
                                ]);
                            ?>
                        </div>
                        <div class="column-responsive column-50">
                            <?php if ($this->Form->isFieldError('origin_errors')) : ?>
                                <?= $this->Form->error('origin_errors', null, ['escape' => false]); ?>
                            <?php else : ?>
                                <div class="message">
                                    <p> <?= __('Please record mandatory information: name and location in comments for a generic origin, or (at least) mother for a registered rattery.') ?></p>
                                    <?= __('If a litter with the same birth date and mother already exists, the rat will be automatically added to it. If not, a new litter will be created with the rat.') ?>
                                </div>
                            <?php endif ; ?>
                        </div>
                    </div>

                    <?php
                        echo $this->Form->control('generic_rattery_id', [
                            'id' => 'alt-generic-rattery-input',
                            'name' => 'generic_rattery_id',
                            'label' => '',
                            'type' => 'radio',
                            'hiddenField' => false,
                            'empty' => __('None of the above (I will select a registered rattery below)'),
                        ]);
                    ?>

                    <div class="radio-complement">
                        <?php
                            echo $this->Form->control('rattery_name', [
                                'id' => 'jquery-rattery-input',
                                'name' => 'rattery_name',
                                'label' => '',
                                'type' => 'text',
                                'placeholder' => __('Type and select the rattery’s name or prefix here...'),
                            ]);

                            echo $this->Form->control('nongeneric_rattery_id', [
                                'id' => 'jquery-rattery-id',
                                'name' => 'nongeneric_rattery_id',
                                'label' => [
                                    'class' => 'hide-everywhere',
                                    'text' => 'Hidden field for rattery ID'
                                ],
                                'class' => 'hide-everywhere',
                                'type' => 'text',
                            ]);
                        ?>
                    </div>

                    <div class="row">
                        <div class="column-responsive column-50">
                            <?php
                                echo $this->Form->control('mother_name', [
                                    'id' => 'jquery-mother-input',
                                    'name' => 'mother_name',
                                    'label' => __('Mother'),
                                    'type' => 'text',
                                    'placeholder' => __('Type and select the mother’s name or identifier here...'),
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
                                ]);
                            ?>
                        </div>
                        <div class="column-responsive column-50">
                            <?php
                                echo $this->Form->control('father_name', [
                                    'id' => 'jquery-father-input',
                                    'name' => 'father_name',
                                    'label' => __('Father'),
                                    'type' => 'text',
                                    'placeholder' => __('Type and select the father’s name or identifier here...'),
                                ]);
                                echo $this->Form->control('father_id', [
                                    'id' => 'jquery-father-id',
                                    'name' => 'father_id',
                                    'label' => [
                                        'class' => 'hide-everywhere',
                                        'text' => 'Hidden field for mother ID'
                                    ],
                                    'class' => 'hide-everywhere',
                                    'type' => 'text',
                                ]);
                            ?>
                        </div>
                    </div>
                <?php else: ?>
                    <legend><?= __('Origins') ?></legend>
                    <div class="button-small">
                        <?= $this->Html->link(__('Cancel'), ['controller' => 'Rats', 'action' => 'add'], ['class' => 'button float-right']); ?>
                    </div>
                    <div><strong><?= __('The rat will be added to the following litter: ')?></strong>
                        <?= $this->Html->link(h($litter->full_name), ['controller' => 'litters', 'action' => 'view', $litter->id]); ?>
                    </div>
                    <div class="spacer"></div>

                    <?php
                        echo $this->Form->hidden('rattery_id', ['name' => 'rattery_id', 'value' => $litter->contributions[0]->rattery_id]);
                        echo $this->Form->hidden('mother_id', ['name' => 'mother_id', 'value' => $litter->dam[0]['id']]);
                        echo $this->Form->hidden('mother_name', ['name' => 'mother_name', 'value' => $litter->dam[0]['name']]);
                    ?>

                <?php endif; ?>

                <legend><?= __('Identity') ?></legend>

                <div class="row">
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('name') ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pup_name') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="column-responsive column-20">
                        <!-- could be done with cake helper form type select, multiple => checkbox -->
                        <?php
                            echo $this->Form->control('sex', [
                                'type' => 'radio',
                                'label' => [
                                    'class' => 'miniradio',
                                ],
                                'required' => 'required',
                                'options' => ['M' => __('Male'), 'F' => __('Female')],
                            ]);
                        ?>
                    </div>
                    <div class="column-responsive column-30">
                        <?php if (! $from_litter): ?>
                            <?= $this->Form->control('birth_date', ['type' => 'date']); ?>
                        <?php else: ?>
                            <?= $this->Form->control('birth_date', ['type' => 'date', 'value' => $litter->birth_date, 'readonly' => true]); ?>
                        <?php endif; ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?php
                            echo $this->Form->control('owner_username', [
                                'id' => 'jquery-owner-input',
                                'name' => 'owner_username',
                                'label' => __('Owner'),
                                'type' => 'text',
                                'placeholder' => __('Type here...'),
                                'empty' => true
                            ]);
                            echo $this->Form->control('owner_user_id', [
                                'id' => 'jquery-owner-id',
                                'name' => 'owner_user_id',
                                'label' => [
                                    'class' => 'hide-everywhere',
                                    'text' => 'Hidden field for owner ID'
                                ],
                                'class' => 'hide-everywhere',
                                'type' => 'text',
                                'empty' => true,
                            ]);
                        ?>
                    </div>
                </div>

                <legend><?= __('Description') ?></legend>
                <?php
                    echo $this->Form->control('color_id', ['id' => 'jquery-color-select', 'empty' => true, 'default' => 0, 'options' => $colors]);
                ?>
                <div class="row">
                    <div class="column-responsive column-50">
                    <?php
                        echo $this->Form->control('eyecolor_id', ['id' => 'jquery-eyecolor-select', 'empty' => true, 'default' => 0, 'options' => $eyecolors]);
                        echo $this->Form->control('dilution_id', ['id' => 'jquery-dilution-select', 'empty' => true, 'default' => 0, 'options' => $dilutions]);
                        echo $this->Form->control('marking_id', ['id' => 'jquery-marking-select', 'empty' => true, 'default' => 0, 'options' => $markings]);
                    ?>
                    </div>
                    <div class="column-responsive column-50">
                    <?php
                        echo $this->Form->control('earset_id', ['id' => 'jquery-earset-select', 'empty' => true, 'default' => 0, 'options' => $earsets]);
                        echo $this->Form->control('coat_id', ['id' => 'jquery-coat-select', 'empty' => true, 'default' => 0, 'options' => $coats]);

                        echo $this->Form->control('singularities._ids', [
                            'id' => 'jquery-singularity-select',
                            'type' => 'select',
                            'multiple' => 'true',
                            'empty' => true,
                            'label' => __('Singularities'),
                            'options' => $singularities
                        ]);
                    ?>
                    </div>
                </div>

                <?= $this->Form->control('picture_file', [
                    'type' => 'file',
                    'label' => __('Photo')
                    ])
                ?>

                <div class="spacer"></div>

                <?php
                    echo $this->Form->control('is_dead', [
                        'type' => 'checkbox',
                        'label' => [
                            'class' => 'legend',
                            'text' => __('Click here to declare death')
                        ],
                    ]);
                ?>

                <!-- if form was reloaded after failed validation rules, reload user inputs -->
                <?php if (isset($rat->is_alive) && ! $rat->is_alive) :?>

                    <div id="death_div">
                        <?php
                            echo $this->Form->control('death_date', [
                                'label' => __('Please enter the death date (or date of last news)'),
                                'id' => 'death_date',
                                'empty' => true,
                                'required' => true,
                            ]);

                            echo $this->Form->control('death_primary_cause_id', [
                                'id' => 'primaries',
                                'label' => __('Select the death cause category'),
                                'options' => $deathPrimaryCauses,
                                'empty' => true,
                                'required' => true,
                            ]);
                        ?>

                        <div id="primary-desc" class="sub-legend">
                            <?php if (! is_null($rat->death_primary_cause_id) && is_null($rat->death_secondary_cause_id)) : ?>
                                <div><?= $rat->death_primary_cause->description ?></div>
                            <?php else : ?>
                                <div><?= __('Please, read carefully information that will appear below to check the fitness of your choice.') ?></div>
                            <?php endif ; ?>
                        </div>

                        <?php
                            echo $this->Form->control('death_secondary_cause_select', [
                                'id' => 'secondaries',
                                'name' => 'death_secondary_cause_id',
                                'label' => __('Select the precise cause of death, if known'),
                                'options' => isset($deathSecondaryCauses) ? $deathSecondaryCauses : '',
                                'value' => ! is_null($rat->death_secondary_cause_id) ? $rat->death_secondary_cause_id : '',
                                'empty' => true,
                                'type' => 'select']);
                        ?>

                        <div id="secondary-desc" class="sub-legend">
                            <div class="markdown">
                                <?php if (! is_null($rat->death_secondary_cause_id)) : ?>
                                    <?= $rat->death_secondary_cause->description ?>
                                <?php else : ?>
                                    <?= __('Please, read carefully information that will appear below to check the fitness of your choice.') ?>
                                <?php endif ; ?>
                            </div>
                        </div>

                        <?php
                            echo $this->Form->control('death_euthanized', [
                                'label' => __('The rat was euthanized'),
                            ]);

                            echo $this->Form->control('death_diagnosed', [
                                'label' => __('The diagnosis was confirmed by a veterinary'),
                            ]);

                            echo $this->Form->control('death_necropsied', [
                                'label' => __('The diagnosis was confirmed by an autopsy or analyses'),
                            ]);
                        ?>
                    </div>

                <!-- first attempt to add this rat -->
                <?php else : ?>
                    <div id="death_div" class="hide-everywhere">
                        <?php
                            echo $this->Form->control('death_date', [
                                'label' => __('Please enter the death date (or date of last news)'),
                                'id' => 'death_date',
                                'empty' => true,
                            ]);

                            echo $this->Form->control('death_primary_cause_id', [
                                'id' => 'primaries',
                                'label' => __('Select the death cause category'),
                                'options' => $deathPrimaryCauses,
                                'empty' => true,
                                'required' => false,
                            ]);

                        ?>

                        <div id="primary-desc" class="sub-legend">
                            <div><?= __('Please, read carefully information that will appear below to check the fitness of your choice.') ?></div>
                        </div>

                        <?php
                            echo $this->Form->control('death_secondary_cause_select', [
                                'id' => 'secondaries',
                                'name' => 'death_secondary_cause_id',
                                'label' => __('Select the precise cause of death, if known'),
                                'empty' => true,
                                'value' => ! is_null($rat->death_secondary_cause_id) ? $rat->death_secondary_cause_id : '',
                                'type' => 'select',
                            ]);
                        ?>

                        <div id="secondary-desc" class="sub-legend">
                            <div class="markdown">
                                <?php if (! is_null($rat->death_secondary_cause_id)) : ?>
                                    <?= $rat->death_secondary_cause->description ?>
                                <?php else : ?>
                                    <?= __('Please, read carefully information that will appear below to check the fitness of your choice.') ?>
                                <?php endif ; ?>
                            </div>
                        </div>

                        <?php
                            echo $this->Form->control('death_euthanized', [
                                'label' => __('The rat was euthanized'),
                            ]); //,'Was the rat euthanized?');

                            echo $this->Form->control('death_diagnosed', [
                                'label' => __('The diagnosis was confirmed by a veterinary'),
                            ]); //,'Was the diagnosis confirmed by a veterinary?');

                            echo $this->Form->control('death_necropsied', [
                                'label' => __('The diagnosis was confirmed by an autopsy or analyses'),
                            ]); //,'Was the diagnosis confirmed by a necropsy or analyses?');
                        ?>
                    </div>
                <?php endif ; ?>

                <div class="spacer"></div>

                <legend><?= __('Additional information') ?></legend>
                <?php
                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Comments'),
                        'rows' => '5',
                        "error" => [
                            "escape" => false
                        ]
                    ]);
                ?>

                <?php echo $this->Form->hidden('creator_user_id', [
                    'name' => 'creator_user_id',
                    'value' => $creator_id,
                ]);
            ?>

            </fieldset>
            <?= $this->Form->button(__('Record rat')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<div id="json-placeholders" data-json="<?= htmlspecialchars($placeholders) ?>"></div>
<div id="json-jsMessages" data-json="<?= htmlspecialchars($js_messages) ?>"></div>

<?= $this->Html->css('jquery.ui.css') ?>
<?= $this->Html->css('selectize.default.css') ?>
<?= $this->Html->css('ajax.css') ?>
<?= $this->Html->css('selectize.milligram.css') ?>

<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('jquery.ui.min.js') ?>
<?= $this->Html->script('selectize.js') ?>

<?= $this->Html->script('rat.js') ?>

<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<?= $this->Html->script('easymde.min.js') ?>
<?= $this->Html->script('easymde-light.js') ?>
