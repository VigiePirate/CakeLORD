<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->assign('title', h($rat->usual_name)) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('tech_sidebar', [
                    'controller' => 'Rats',
                    'object' => $rat,
                    'tooltip' => 'Browse Rat List',
                    'can_cancel' => true,
                    'show_staff' => $show_staff,
                    'user' => $user
                ])
            ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Rats') ?></div>
            </div>
            <h1><?=__('Edit {0}', [$rat->usual_name]) ?></h1>

            <?= $this->Flash->render() ?>

            <?= $this->Form->setValueSources(['context', 'data'])->create($rat, ['type' => 'file']) ?>

            <fieldset>
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
                        <!-- birth date must be edited through birth litter if there is one -->
                        <?php if ($user->can('staffEdit', $rat) && ! isset($rat->litter_id)) : ?>
                            <?= $this->Form->control('birth_date', ['type' => 'date', 'value' => $rat->birth_date, 'label' => ['class' => 'staff']]); ?>
                        <?php else : ?>
                            <?= $this->Form->control('birth_date', ['type' => 'date', 'value' => $rat->birth_date, 'readonly' => true]); ?>
                        <?php endif ; ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?php
                            echo $this->Form->control('owner_username', [
                                'id' => 'jquery-owner-input',
                                'name' => 'owner_username',
                                'label' => __('Owner'),
                                'type' => 'text',
                                'placeholder' => __('Type here...'),
                                'value' => $rat->owner_user->username,
                                'empty' => true,
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
                                'value' => $rat->owner_user_id,
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
                    $this->Form->setTemplates([
                        'checkboxContainer' => '<div class="input checkbox special-check">{{content}}</div>',
                        'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                    ]);

                    echo $this->Form->control('is_dead', [
                        'type' => 'checkbox',
                        'value' => $rat->is_alive,
                        'label' => [
                            'id' => 'dead_label',
                            'class' => 'legend',
                            'text' => $rat->is_alive ? __('Click here to declare death') : __('Uncheck this box if death was declared erroneously'),
                        ],
                    ]);

                    $this->Form->setTemplates([
                        'checkboxContainer' => '<div class="input checkbox">{{content}}</div>',
                        'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
                    ]);

                ?>

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

                <!-- edit alive rat -->
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

                <legend><?= __('Comments') ?></legend>
                <?php
                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Amend sheet comments'),
                        'rows' => '5',
                        "error" => [
                            "escape" => false
                        ]
                    ]);
                ?>

                <?php
                    echo $this->Form->hidden('creator_user_id', [
                        'name' => 'creator_user_id',
                        'value' => $rat->creator_user->username,
                    ]);
                ?>

                <?php if ($user->can('staffEdit', $rat)) : ?>
                    <h2 class="staff"><?= __('Staff-only') ?></h2>
                    <div class="row row-reverse">
                        <div class="column-responsive column-50">
                            <?php
                                echo $this->Form->control('generic_rattery_id', [
                                    'id' => 'generic-rattery-input',
                                    'name' => 'generic_rattery_id',
                                    'label' => __('Attach rat to a generic rattery'),
                                    'type' => 'radio',
                                    'options' => $generic,
                                    'empty' => false,
                                ]);

                                echo $this->Form->control('update_identifier', [
                                    'label' => ['text' => __('Update pedigree identifier?')],
                                    'type' => 'checkbox',
                                    'default' => false,
                                ]);
                            ?>
                        </div>
                        <div class="column-responsive column-50">
                            <div class="message warning">
                                <p><?= __('Use with care!')?></p>
                                <?= __('This section allows to change the rat prefix to a generic prefix only. Leave unselected to keep rat prefix unchanged, or used the rat attach function for a non-generic prefix.') ?>
                            </div>
                        </div>
                    </div>
                <?php endif ; ?>

                <?=
                    $this->element('side_message_control', [
                        'ignore_staff' => ! $user->can('staffEdit', $rat),
                        'user' => $user,
                        'sheet' => $rat,
                        'required' => false,
                    ]);
                ?>

            </fieldset>
            <?= $this->Form->button(__('Save changes')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?php $this->append('css');?>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.css" />
<?php $this->end();?>

<?= $this->Html->css('ajax.css') ?>
<?= $this->Html->css('selectize.milligram.css') ?>

<?php $this->append('script');?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- general select2 ; French version at: cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/fr.min.js -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" type="text/javascript"></script> -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.js"></script>

    <script>
    $(function() {
        $(window).on('load', function() {
            if (! $("#jquery-owner-id").val() == '') {
                $("#jquery-owner-input").addClass("autocompleted");
            }
        });
    });
    </script>

    <script>
    $(function () {
        $('#jquery-owner-input')
            .on('input', function() {
                $("#jquery-mother-id").val('');
                if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                    $(this).removeClass('autocompleted');
                }
            })
            .autocomplete({
                minLength: 3,
                source: function (request, response) {
                    $.ajax({
                        /*url: $('#jquery-owner-form').attr('action') + '.json',*/
                        url: '/users/autocomplete.json',
                        dataType: 'json',
                        data: {
                            'searchkey': $('#jquery-owner-input').val(),
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
                    $("#jquery-owner-input").val(ui.item.value); // display the selected text
                    $("#jquery-owner-input").addClass("autocompleted"); // display the selected text
                    $("#jquery-owner-id").val(ui.item.id); // save selected id to hidden input
                }
            }
        );
    });
    </script>

    <script>
    var placeholders = <?= $placeholders ?>;
        $(function () {
            $("#jquery-color-select").selectize( {
                placeholder: placeholders['colors'],
                maxItems: 1,
                plugins: ['remove_button']
            });
        });
        $(function () {
            $("#jquery-eyecolor-select").selectize( {
                placeholder: placeholders['eyecolors'],
                maxItems: 1,
                plugins: ['remove_button']
            });
        });
        $(function () {
            $("#jquery-coat-select").selectize( {
                placeholder: placeholders['coats'],
                maxItems: 1,
                plugins: ['remove_button']
            });
        });
        $(function () {
            $("#jquery-dilution-select").selectize( {
                placeholder: placeholders['dilutions'],
                maxItems: 1,
                plugins: ['remove_button']
            });
        });
        $(function () {
            $("#jquery-earset-select").selectize( {
                placeholder: placeholders['earsets'],
                maxItems: 1,
                plugins: ['remove_button']
            });
        });
        $(function () {
            $("#jquery-marking-select").selectize( {
                placeholder: placeholders['markings'],
                maxItems: 1,
                plugins: ['remove_button']
            });
        });
        $(function () {
            $("#jquery-singularity-select").selectize( {
                placeholder: placeholders['singularities'],
                maxItems: 8,
                plugins: ['remove_button']
            });
        });
    </script>

    <!-- death -->
    <script>
    var jsMessages = <?php echo $js_messages; ?>;
    var boxLabels = [
        <?= '"' . __('Click here to declare death') . '"' ?>,
        <?= '"' . __('Uncheck this box if death was declared erroneously') . '"' ?>
    ];

    $(function() {
        $('#is-dead').on('change', function() {
            var show_death = $(this).is(':checked');
            if (show_death === true) {
                $('#death_div').removeClass("hide-everywhere");
                $('#death_date').prop('required', true);
                $('#primaries').prop('required', true);
                $('#dead_label').html(boxLabels[1]);
                //console.log($('#dead_label').next());
            } else {
                $('#death_div').addClass("hide-everywhere");
                $('#death_date').prop('required', false);
                $('#primaries').prop('required', false);
                $('#dead_label').html(boxLabels[0]);
            };
        });

    	$('#primaries').change(function() {
    		$.ajax({
                url: '/death-secondary-causes/find-by-primary.json',
                dataType: 'json',
                data: {
                    'deathprimarykey': $('#primaries').val(),
                },
    			success: function(data) {
                    $("#secondaries option").remove();
                    $('#secondaries').append($("<option></option>").attr("value","").text(""));
                    $('#secondary-desc').empty();
                    $('#secondary-desc').append(jsMessages[0]);
                    for (var item in data.items) {
                        var x = document.getElementById("secondaries");
                        var option = document.createElement("option");
                        option.value = data.items[item].id;
                        option.text = data.items[item].value;
                        x.add(option);
                    }
                },
            });
    	});
    });
    </script>

    <script>
    $(function() {
        $('#primaries')
            .change(function() {
        		$.ajax({
                    url: '/death-primary-causes/description.json',
                    dataType: 'json',
                    data: {
                        'id': $('#primaries').val(),
                    },
                    success: function(data) {
                        var p = document.getElementById("primary-desc");
                        var comment = data.items['0'].value;
                        if (comment == "-") {
                            p.innerHTML = jsMessages[1];
                        } else {
                            p.innerHTML = comment;
                        }
                    },
                });
            });
    });
    </script>

    <script>
    $(function() {
        $('#secondaries')
            .change(function() {
        		$.ajax({
                    url: '/death-secondary-causes/description.json',
                    dataType: 'json',
                    data: {
                        'id': $('#secondaries').val(),
                    },
                    success: function(data) {
                        var p = document.getElementById("secondary-desc");
                        var comment = data.items['0'].value;
                        if (comment == "-") {
                            p.innerHTML = jsMessages[1];
                        } else {
                            p.innerHTML = comment;
                        }
                    },
                });
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
