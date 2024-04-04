<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>

<?php $this->assign('title', __('New Litter')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar', ['help_url' => ['controller' => 'Articles', 'action' => 'view', 32]]) ?>
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
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>
            <h1><?=__('Record a new litter') ?></h1>

            <?= $this->Flash->render() ?>

            <?php if ($from_parent): ?>
                <div class="button-small">
                    <?= $this->Html->link(__('Cancel'), ['controller' => 'Rats', 'action' => 'add'], ['class' => 'button float-right']); ?>
                </div>
                <?php if (isset($mother)): ?>
                    <div><strong><?= __('The litter will be recorded as born from the following mother: ')?></strong>
                        <?= $this->Html->link(h($mother['name']), ['controller' => 'rats', 'action' => 'view', $mother['id']]); ?>
                    </div>

                <?php endif; ?>
                <?php if (isset($father)): ?>
                    <div><strong><?= __('The litter will be recorded as born from the following father: ')?></strong>
                        <?= $this->Html->link(h($father['name']), ['controller' => 'rats', 'action' => 'view', $father['id']]); ?>
                    </div>
                <?php endif; ?>
                <div class="spacer"></div>
            <?php endif; ?>

            <?= $this->Form->setValueSources(['context', 'data'])->create($litter) ?>
            <fieldset>
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

                        <?php if ($from_parent && isset($mother)): ?>
                            <?php
                                echo $this->Form->control('mother_name', [
                                    'name' => 'mother_name',
                                    'label' => __('Mother'),
                                    'value' => $mother['name'],
                                    'readonly' => true
                                ]);
                                echo $this->Form->control('mother_id', [
                                    'name' => 'mother_id',
                                    'label' => [
                                        'class' => 'hide-everywhere',
                                        'text' => 'Hidden field for mother ID'
                                    ],
                                    'class' => 'hide-everywhere',
                                    'type' => 'text',
                                    'value' => $mother['id'],
                                    'readonly' => true
                                ]);
                            ?>
                        <?php else: ?>
                            <?php
                                echo $this->Form->control('mother_name', [
                                    'id' => 'jquery-mother-input',
                                    'name' => 'mother_name',
                                    'label' => __('Mother'),
                                    'type' => 'text',
                                    'required' => 'required',
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
                        <?php endif; ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?php if ($from_parent && isset($father)): ?>
                            <?php
                                echo $this->Form->control('father_name', [
                                    'name' => 'father_name',
                                    'label' => __('Father'),
                                    'value' => $father['name'],
                                    'readonly' => true
                                ]);
                                echo $this->Form->control('father_id', [
                                    'name' => 'father_id',
                                    'label' => [
                                        'class' => 'hide-everywhere',
                                        'text' => 'Hidden field for father ID'
                                    ],
                                    'class' => 'hide-everywhere',
                                    'type' => 'text',
                                    'value' => $father['id'],
                                    'readonly' => true
                                ]);
                            ?>
                        <?php else: ?>
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
                        <?php endif; ?>
                    </div>
                </div>

                <legend><?= __('Dates') ?></legend>
                <div class="row">
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('birth_date'); ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('mating_date', ['empty' => true, 'label' => __('Mating date')]); ?>
                    </div>
                </div>

                <legend><?= __('Pups') ?></legend>
                <div class="row">
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pups_number', ['empty' => false, 'default' => '1', 'label' => __('Pup count (including stillborn)')]); ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pups_number_stillborn', ['empty' => true, 'label' => __('Stillborn pup count')]); ?>
                    </div>
                </div>

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
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->css('jquery.ui.css') ?>
<?= $this->Html->css('ajax.css') ?>
<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('jquery.ui.min.js') ?>
<?= $this->Html->script('litter.js') ?>

<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<?= $this->Html->script('easymde.min.js') ?>
<?= $this->Html->script('easymde-light.js') ?>
