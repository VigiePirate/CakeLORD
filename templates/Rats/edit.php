<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
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
                                'options' => ['M' => 'Male', 'F' => 'Female'],
                            ]);
                        ?>
                    </div>
                    <div class="column-responsive column-30">
                        <?= $this->Form->control('birth_date', ['type' => 'date', 'value' => $rat->birth_date, 'readonly' => true]); ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?php
                            echo $this->Form->control('owner_username', [
                                'id' => 'jquery-owner-input',
                                'name' => 'owner_username',
                                'label' => __('Owner'),
                                'type' => 'text',
                                'placeholder' => __('Type here...'),
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
                            echo $this->Form->control('eyecolor_id', ['id' => 'jquery-eyecolor-select', 'empty' => false, 'default' => 2, 'options' => $eyecolors]);
                            echo $this->Form->control('dilution_id', ['id' => 'jquery-dilution-select', 'empty' => false, 'default' => 1, 'options' => $dilutions]);
                            echo $this->Form->control('marking_id', ['id' => 'jquery-marking-select', 'empty' => false, 'default' => 2, 'options' => $markings]);
                        ?>
                        </div>
                    <div class="column-responsive column-50">
                        <?php
                            echo $this->Form->control('earset_id', ['id' => 'jquery-earset-select', 'empty' => false, 'default' => 2, 'options' => $earsets]);
                            echo $this->Form->control('coat_id', ['id' => 'jquery-coat-select', 'empty' => false, 'default' => 2, 'options' => $coats]);

                            echo $this->Form->control('singularities._ids', [
                                'id' => 'jquery-singularity-select',
                                'type' => 'select',
                                'multiple' => 'true',
                                'empty' => true,
                                'default' => 0,
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

                <legend><?= __('Comments') ?></legend>
                <?php
                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Additional information'),
                        'rows' => '5',
                        "error" => [
                            "escape" => false
                        ]
                    ]);
                ?>

                <?php echo $this->Form->hidden('creator_user_id', [
                    'name' => 'creator_user_id',
                    'value' => $rat->creator_user->username,
                ]);
            ?>

            <?php if ($user->can('staffEdit', $rat)) : ?>
                <h2 class="staff"><?= __('Staff-only') ?></h2>

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
                        <div class="message">
                            <p><?= __('Please record mandatory information: name and location in comments for a generic origin, or (at least) mother for a registered rattery.')?></p>
                            <?= __('If a litter with the same birth date and mother already exists, the rat will be automatically added to it. If not, a new litter will be created with the rat.') ?>
                        </div>
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
                        'checked' => 'checked'
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
            <?php endif; ?>

            </fieldset>
            <?= $this->Form->button(__('Record rat')) ?>
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
    $(function () {
        $('#jquery-owner-input').autocomplete({
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
                // $("#jquery-owner-input").addClass('has-items'); // add class for css
                $("#jquery-owner-id").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-owner-input").on("input", function(){
            $("#jquery-owner-id").val('');
        });
    });
    </script>
    <script>
    // autocomplete for mother
    $(function () {
        $('#jquery-mother-input').autocomplete({
            minLength: 4,
            source: function (request, response) {
                $.ajax({
                    /*url: $('#jquery-owner-form').attr('action') + '.json',*/
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
                $("#jquery-mother-id").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-mother-input").on("input", function(){
            $("#jquery-mother-id").val('');
        });
    });
    </script>
    <script>
    // autocomplete for father
    $(function () {
        $('#jquery-father-input').autocomplete({
            minLength: 2,
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
                $("#jquery-father-id").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-father-input").on("input", function(){
            $("#jquery-father-id").val('');
        });
    });
    </script>
    <script>
    // autocomplete for rattery
    $(function () {
        $('#jquery-rattery-input').autocomplete({
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
                $("#jquery-rattery-id").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-rattery-input").on("input", function(){
            $("#jquery-rattery-id").val('');
        });
    });
    </script>
    <script>
    $(function () {
        $("#jquery-color-select").selectize( {
            placeholder : 'Type here to filter colors...',
            maxItems: 1,
            plugins: ['remove_button']
        });
     });
     $(function () {
         $("#jquery-eyecolor-select").selectize( {
             placeholder : 'Type here to filter eyecolors...',
             maxItems: 1,
             plugins: ['remove_button']
         });
      });
      $(function () {
          $("#jquery-coat-select").selectize( {
              placeholder : 'Type here to filter coats...',
              maxItems: 1,
              plugins: ['remove_button']
          });
       });
       $(function () {
           $("#jquery-dilution-select").selectize( {
               placeholder : 'Type here to filter dilutions...',
               maxItems: 1,
               plugins: ['remove_button']
           });
        });
        $(function () {
            $("#jquery-earset-select").selectize( {
                placeholder : 'Type here to filter earsets...',
                maxItems: 1,
                plugins: ['remove_button']
            });
         });
         $(function () {
             $("#jquery-marking-select").selectize( {
                 placeholder : 'Type here to filter markings...',
                 maxItems: 1,
                 plugins: ['remove_button']
             });
          });
          $(function () {
              $("#jquery-singularity-select").selectize( {
                  placeholder : 'Type here to filter singularities...',
                  maxItems: 8,
                  plugins: ['remove_button']
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
