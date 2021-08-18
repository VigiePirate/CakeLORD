<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="tooltip">
                <?= $this->Html->image('/img/icon-report.svg', [
                    'url' => ['controller' => 'Conversations', 'action' => 'add'],
                    'class' => 'side-nav-icon',
                    'alt' => __('Report')]) ?>
                <span class="tooltiptext">Report a problem</span>
            </div>

            <?= $this->Html->image('/img/icon-help.svg', [
                'url' => ['controller' => 'Articles', 'action' => 'index'],
                'class' => 'side-nav-icon',
                'alt' => __('Help')]) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Rats') ?></div>
            </div>
            <h1><?=__('Record a new rat') ?></h1>

            <?= $this->Flash->render() ?>

            <?= $this->Form->create($rat) ?>

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
                        <?php
                            echo $this->Form->control('birth_date', ['type' => 'date']);
                        ?>
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

                <legend><?= __('Origins') ?></legend>

                <?php
                    echo $this->Form->control('rattery_name', [
                        'id' => 'jquery-rattery-input',
                        'name' => 'rattery_name',
                        'label' => __('Birth place'),
                        'type' => 'text',
                        'required' => 'required',
                        'placeholder' => __('Type and select the rattery’s name or prefix here...'),
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
                    ]);
                ?>

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

                <legend><?= __('Description') ?></legend>
                <?php
                    echo $this->Form->control('colors', [
                        'id' => 'jquery-color-select',
                        'type' => 'select',
                        'empty' => true,
                        'multiple' => 'true',
                        'default' => 0,
                        'label' => __('Color'),
                        'options' => $colors
                    ]);
                ?>
                <div class="row">
                    <div class="column-responsive column-50">
                    <?php
                        echo $this->Form->control('eyecolor_id', ['empty' => true, 'default' => 0, 'options' => $eyecolors]);
                        echo $this->Form->control('dilution_id', ['empty' => true, 'default' => 0, 'options' => $dilutions]);
                        echo $this->Form->control('marking_id', ['empty' => true, 'default' => 0, 'options' => $markings]);
                    ?>
                    </div>
                    <div class="column-responsive column-50">
                    <?php
                        echo $this->Form->control('earset_id', ['empty' => true, 'default' => 0, 'options' => $earsets]);
                        echo $this->Form->control('coat_id', ['empty' => true, 'default' => 0, 'options' => $coats]);
                        /*echo $this->Form->control('singularities._ids', ['empty' => true, 'default' => 0, 'options' => $singularities, 'size' => '13', 'style' => 'height:auto;']);*/
                        echo $this->Form->control('singularity_id', ['empty' => true, 'default' => 0, 'options' => $singularities]);
                    ?>
                    </div>
                </div>

                <legend><?= __('Comments') ?></legend>
                <?php
                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Comments'),
                        'rows' => '5',
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Create litter')) ?>
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
        });
     });
    </script>
<?php $this->end();
