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
                <?= $this->element('default_sidebar') ?>
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

<?php $this->append('css');?>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<?php $this->end();?>
<?= $this->Html->css('ajax.css') ?>

<?php $this->append('script');?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
    $(function() {
        $(window).on('load', function() {
            if (! $("#jquery-mother-id").val() == '') {
                $("#jquery-mother-input").addClass("autocompleted");
            }
            if (! $("#jquery-father-id").val() == '') {
                $("#jquery-father-input").addClass("autocompleted");
            }
            if (! $("#jquery-rattery-id").val() == '') {
                $("#jquery-rattery-input").addClass("autocompleted");
            }
        });
    });
    </script>

    <script>
    // autocomplete for mother
    $(function () {
        $('#jquery-mother-input')
            .on('input', function() {
                $("#jquery-mother-id").val('');
                if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                    $(this).removeClass('autocompleted');
                }
            })
            .autocomplete({
                minLength: 4,
                source: function (request, response) {
                    $.ajax({
                        url: '/rats/autocomplete.json',
                        dataType: 'json',
                        data: {
                            'searchkey': $('#jquery-mother-input').val(),
                            'sex': 'F',
                        },
                        success: function (data) {
                            response(data.items);
                        },
                        open: function () {
                            $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                        },
                        close: function () {
                            $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                        }
                    });
                },
                select: function (event, ui) {
                    $("#jquery-mother-input").val(ui.item.value); // display the selected text
                    $("#jquery-mother-input").addClass("autocompleted"); // apply style
                    $("#jquery-mother-id").val(ui.item.id); // save selected id to hidden input
                }
            });
    });
    </script>
    <script>
    // autocomplete for father
    $(function () {
        $('#jquery-father-input')
            .on('input', function() {
                $("#jquery-father-id").val('');
                if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                    $(this).removeClass('autocompleted');
                }
            })

            .autocomplete({
                minLength: 4,
                source: function (request, response) {
                    $.ajax({
                        /*url: $('#jquery-owner-form').attr('action') + '.json',*/
                        url: '/rats/autocomplete.json',
                        dataType: 'json',
                        data: {
                            'searchkey': $('#jquery-father-input').val(),
                            'sex': 'M',
                        },
                        success: function (data) {
                            response(data.items);
                        },
                        open: function () {
                            $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                        },
                        close: function () {
                            $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                        }
                    });
                },
                select: function (event, ui) {
                    $("#jquery-father-input").val(ui.item.value); // display the selected text
                    $("#jquery-father-input").addClass("autocompleted"); // display the selected text
                    $("#jquery-father-id").val(ui.item.id); // save selected id to hidden input
                }
            });
    });
    </script>
    <script>
    // autocomplete for rattery
    $(function () {
        $('#jquery-rattery-input')
            .on('input', function() {
                $("#jquery-rattery-id").val('');
                if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                    $(this).removeClass('autocompleted');
                }
            })
            .autocomplete({
                minLength: 2,
                source: function (request, response) {
                    $.ajax({
                        /*url: $('#jquery-owner-form').attr('action') + '.json',*/
                        url: '/ratteries/autocomplete.json',
                        dataType: 'json',
                        data: {
                            'searchkey': $('#jquery-rattery-input').val(),
                        },
                        success: function (data) {
                            response(data.items);
                        },
                        open: function () {
                            $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                        },
                        close: function () {
                            $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                        }
                    });
                },
                select: function (event, ui) {
                    $("#jquery-rattery-input").val(ui.item.value); // display the selected text
                    $("#jquery-rattery-input").addClass("autocompleted"); // display the selected text
                    $("#jquery-rattery-id").val(ui.item.id); // save selected id to hidden input
                }
            });
    });
    </script>
<?php $this->end(); ?>

<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

<script>
    var easyMDE = new EasyMDE({
        minHeight: "20rem",
        spellChecker: false,
        inputStyle: "contenteditable",
        nativeSpellcheck: true,
        previewImagesInEditor: true,
        promptURLs: true,
        sideBySideFullscreen: false,
        toolbar: [
            "bold", "italic", "strikethrough", "|",
            "unordered-list", "ordered-list", "table", "|",
            "link", "|",
            "side-by-side", "fullscreen", "preview", "|",
            "guide"
        ]
    });
    easyMDE.toggleSideBySide();
</script>
