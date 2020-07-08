<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
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
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Declare Death of ') ?></div>
            </div>

            <h1><?= $rat->usual_name . ' (' . $rat->pedigree_identifier . ')' ?></h1>

            <div class="message default">
                We are sorry for your loss. Please fill the information below to record the rat death. Date and primary cause are mandatory.
            </div>

            <?php
            echo $this->Form->create($rat, [
            	'id' => 'jquery-death-form',
            ]); ?>

            <fieldset>
                <legend><?= __('Main information') ?></legend>
                <?php
                    echo $this->Form->control('death_date', ['label' => __('Please enter the death date (or date of last news)'), 'empty' => true, 'required' => true]);
                    echo $this->Form->control('death_primary_cause_id', [
                        'id' => 'primaries',
                        'label' => __('Select the death cause category'),
                        'options' => $deathPrimaryCauses,
                        'empty' => true,
                        'required' => true
                    ]);
                    echo $this->Form->control('death_secondary_cause_select', [
                        'id' => 'secondaries',
                        'name' => 'death_secondary_cause_id',
                        'label' => __('Select the precise cause of death, if known'),
                        'empty' => true,
                        'type' => 'select']);
                ?>
                <div id="secondary-desc" class="message warning">
                    Please, read carefully information that will appear below to check the fitness of your choice.
                </div>
                <legend><?= __('Complementary information') ?></legend>
                <?php
                    echo $this->Form->control('death_euthanized', ['label' => __('The rat was euthanized')]); //,'Was the rat euthanized?');
                    echo $this->Form->control('death_diagnosed', ['label' => __('The diagnosis was confirmed by a veterinary')]); //,'Was the diagnosis confirmed by a veterinary?');
                    echo $this->Form->control('death_necropsied', ['label' => __('The diagnosis was confirmed by an autopsy or analyses')]); //,'Was the diagnosis confirmed by a necropsy or analyses?');
                ?>
                <legend><?= __('Comments') ?></legend>
                <?php
                    echo $this->Form->control('comments', [
                        'id' => 'comments',
                        'name' => 'comments',
                        'label' => __('Append comments if needed'),
                        'value' => $rat->comments,
                        'rows' => '5',
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Declare Death')); ?>
            <?= $this->Form->end(); ?>
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
                    $('#secondary-desc').append("Please, read carefully information that will appear below to check the fitness of your choice.");
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
        $('#secondaries').change(function() {
    		$.ajax({
                url: '/death-secondary-causes/description.json',
                dataType: 'json',
                data: {
                    'id': $('#secondaries').val(),
                },
    			success: function(data) {
                    var p = document.getElementById("secondary-desc");
                    p.innerText = data.items['0'].value;
                    //$('#secondary-desc').appendChild(data.items['0'].value);
                },
            });
        });
    });
    </script>

<?php $this->end();

/* $(function () {
    $('#jquery-primary-select'). ...somefunction...  ({
        source: function (request, response) {
            $.ajax({

                url: '/death-secondary-causes/find-by-primary.json',
                dataType: 'json',
                data: {
                    'deathprimarykey': $('#jquery-primary-select').val(),
                },
                success: function (data) {
                    console.log(data.items);
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
            $("#jquery-secondary-select").val(ui.item.value); // display the selected text
            $("#jquery-secondary-desc").val(ui.item.label);
            $("#jquery-secondary-id").val(ui.item.id); // save selected id to hidden input
            console.log(ui.item);
        }
    });
}); */
