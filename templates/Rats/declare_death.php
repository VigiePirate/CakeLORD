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
            <div class="side-nav-group">
                <?= $this->element('default_sidebar', ['help_url' => ['controller' => 'Articles', 'action' => 'view', 27]]) ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to rat sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Declare Death of ') ?></div>
                <div class="tooltip-state">
                    <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                    <span class="tooltiptext-state hide-on-mobile"><?= h($rat->state->name) ?></span>
                </div>
            </div>

            <h1><?= $rat->usual_name . ' (' . $rat->pedigree_identifier . ')' ?></h1>

            <?= $this->Flash->render(); ?>

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
                    <div class="markdown">
                        <?= __('Please, read carefully information that will appear below to check the fitness of your choice.') ?>
                    </div>
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
                        'type' => 'textarea',
                        'id' => 'comments',
                        'name' => 'comments',
                        'label' => __('Amend sheet comments'),
                        'value' => $rat->comments,
                        'rows' => '5',
                    ]);
                ?>

                <?= $this->element('side_message_control') ?>
            </fieldset>
            <?= $this->Form->button(__('Declare Death')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>

<?php $this->append('css');?>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<?php $this->end();?>
<?= $this->Html->css('ajax.css') ?>
<?php $this->append('script');?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
    var jsMessages = <?php echo $js_messages; ?>;

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
        $('#secondaries').change(function() {
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

<!-- /* $(function () {
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
}); */ -->
