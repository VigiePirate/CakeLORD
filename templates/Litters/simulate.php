<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>
            <h1><?=__('Simulate a litter') ?></h1>

            <?= $this->Flash->render() ?>
            <?= $this->Form->setValueSources(['context', 'data'])->create($litter) ?>

            <fieldset>
                <legend><?= __('Enter potential parents') ?></legend>
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
                                'required' => 'required',
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

            </fieldset>

            <?= $this->Form->button(__('Launch simulation')) ?>
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

<?php $this->end(); ?>
