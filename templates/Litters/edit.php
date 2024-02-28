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

<?php $this->append('css');?>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<?php $this->end();?>
<?= $this->Html->css('ajax.css') ?>
<?= $this->Html->css('selectize.milligram.css') ?>

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
            }
        );
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
