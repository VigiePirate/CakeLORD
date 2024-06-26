<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->assign('title', __('Search')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar', ['help_url' => ['controller' => 'Articles', 'action' => 'view', 22]]) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Rats') ?></div>
            </div>

            <h1><?= __('Advanced search') ?></h1>

            <?php if ($new_search) : ?>
                <div class="message default">
                    <?= __('Please fill in your search criteria below. You can leave empty the criteria you do not want to use.') ?>
                </div>
            <?php else : ?>
            <details>
            <summary class="h2"><?= __('New search') ?></summary>
            <?php endif; ?>

                <?php echo $this->Form
                    ->setValueSources(['query', 'context'])
                    ->create($rat, [
                	'id' => 'jquery-search-form',
                    'url' => ['action' => 'results'],
                ]); ?>
                <fieldset>
                    <legend><?= __('Identity criteria') ?></legend>
                    <?php
                        echo $this->Form->control('namekey', ['label' => __('Name')]);
                    ?>
                    <div class="row">
                        <div class="column-responsive column-20">
                            <label><?= __('Sex') ?></label>
                            <!-- could be done with cake helper form type select, multiple => checkbox -->
                            <?php
                                echo $this->Form->control('sex_f', [
                                    'type' => 'checkbox',
                                    'default' => true,
                                    'label' => [
                                        'class' => 'minicheck',
                                        'text' => __('Female'),
                                    ],
                                ]);
                                echo $this->Form->control('sex_m', [
                                    'type' => 'checkbox',
                                    'default' => true,
                                    'label' => [
                                        'class' => 'minicheck',
                                        'text' => __('Male'),
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="column-responsive column-40">
                            <?php
                                echo $this->Form->control('rattery_name', [
                                    'id' => 'jquery-rattery-input',
                                    'name' => 'rattery_name',
                                    'label' => __('Origin'),
                                    'type' => 'text',
                                    'placeholder' => __('Type here...'),
                                    'empty' => true,
                                    'default' => '',
                                ]);
                                echo $this->Form->control('rattery_id', [
                                    'id' => 'jquery-rattery-id',
                                    'name' => 'rattery_id',
                                    'label' => [
                                        'class' => 'hide-everywhere',
                                        'text' => 'Hidden field for rattery ID'
                                    ],
                                    'class' => 'hide-everywhere',
                                    'type' => 'text',
                                    'empty' => true,
                                    'default' => '',
                                ]);
                            ?>
                        </div>
                        <div class="column-responsive column-40">
                            <?php
                                echo $this->Form->control('owner_username', [
                                    'id' => 'jquery-owner-input',
                                    'name' => 'owner_username',
                                    'label' => __('Owner'),
                                    'type' => 'text',
                                    'placeholder' => __('Type here...'),
                                    'empty' => true,
                                    'default' => '',
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
                                    'default' => '',
                                ]);
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column-responsive column-20">
                            <label><?= __('Health') ?></label>
                            <?php
                                echo $this->Form->control('alive', [
                                    'type' => 'checkbox',
                                    'default' => true,
                                    'label' => [
                                        'class' => 'minicheck',
                                        'text' => __('Alive'),
                                    ],
                                ]);
                                echo $this->Form->control('deceased', [
                                    'type' => 'checkbox',
                                    'default' => true,
                                    'label' => [
                                        'class' => 'minicheck',
                                        'text' => __('Deceased'),
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="column-responsive column-40">
                            <?php
                                echo $this->Form->control('birth_date_after', ['type' => 'date', 'label' => __('Born after...')]);
                            ?>
                        </div>
                        <div class="column-responsive column-40">
                            <?php
                                echo $this->Form->control('birth_date_before', ['type' => 'date', 'label' => __('Born before...')]);
                            ?>
                        </div>
                    </div>


                    <legend><?= __('Physical criteria') ?></legend>
                    <?php
                        echo $this->Form->control('colors', [
                            'id' => 'jquery-color-select',
                            'type' => 'select',
                            'multiple' => 'true',
                            'empty' => true,
                            'default' => 0,
                            'label' => __('Color'),
                            'options' => $colors
                        ]);
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
                            echo $this->Form->control('singularity_id', ['id' => 'jquery-singularity-select', 'empty' => true, 'default' => 0, 'options' => $singularities]);
                        ?>

                        </div>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('Search')) ?>
                <?= $this->Form->end() ?>

            <?php if( !$new_search ) : ?>
            </details>
            <?php endif; ?>

            <?php if( !$new_search ) : ?>
                <div class="spacer"> </div>
                <h2><?= __('Results') ?> <?= ($this->Paginator->counter(__('{{pages}}'))== '1') ? '' : ' (' . $this->Paginator->counter(__('{{page}}/{{pages}}')) . ')' ?></h2>

                <?php if ( empty($rats->toList()) ) : ?>
                    <div class="message error"><?= __('Sorry, no rat matches your criteria. You can try again above.') ?></div>
                <?php else : ?>

                <?= $this->element('rats', [
                    'rubric' => __(''),
                    'exceptions' => [
                        'picture',
                        'age_string',
                        'death_cause',
                        'actions',
                    ],
                ]) ?>

                <?php endif; ?>

            <?php endif; ?>
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
            if (! $("#jquery-rattery-id").val() == '') {
                $("#jquery-rattery-input").addClass("autocompleted");
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
    <script>
    var placeholders = <?= $placeholders ?>;
        $(function () {
            $("#jquery-color-select").selectize( {
                placeholder: placeholders['colors'],
                maxItems: 8,
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
                maxItems: 1,
                plugins: ['remove_button']
            });
        });
    </script>
<?php $this->end();
