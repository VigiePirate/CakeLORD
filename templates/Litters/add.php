<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-fa-alert.svg', [
                'url' => ['controller' => 'Conversations', 'action' => 'add'],
                'class' => 'side-nav-icon',
                'alt' => __('Report')]) ?>
            <?= $this->Html->image('/img/icon-help.svg', [
                'url' => ['controller' => 'Articles', 'action' => 'index'],
                'class' => 'side-nav-icon',
                'alt' => __('Help')]) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>
            <h1><?=__('Record a new litter') ?></h1>

            <?= $this->Flash->render() ?>

            <?= $this->Form->create($litter) ?>
            <fieldset>
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

                <legend><?= __('Dates') ?></legend>
                <div class="row">
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('birth_date'); ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('mating_date', ['empty' => true]); ?>
                    </div>
                </div>

                <legend><?= __('Pups') ?></legend>
                <div class="row">
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pups_number', ['empty' => false, 'default' => '1', 'label' => 'Pup number']); ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pups_number_stillborn', ['empty' => true, 'label' => 'Stillborn pup number']); ?>
                    </div>
                </div>

                <legend><?= __('Comments') ?></legend>
                <?= $this->Form->control('comments', ['label' => 'Additional information']); ?>
            </fieldset>
            <?= $this->Form->button(__('Submit (do not press for now!)')) ?>
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
<?php $this->end();
