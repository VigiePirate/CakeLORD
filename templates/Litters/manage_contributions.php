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
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Manage Litter Contributions of') ?></div>
                <div class="sheet-markers">
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($litter->state->name) ?></span>
                    </div>
                </div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <?= $this->Flash->render() ?>

            <?php echo $this->Form->setValueSources(['context', 'data'])->create($litter); ?>
            <fieldset>
            <?php foreach($contribution_types as $type) : ?>
                <?php
                    echo $this->Form->control('rattery_name_contribution_' . $type->id, [
                        'id' => 'jquery-rattery-input-' . $type->id,
                        'name' => 'rattery_name_contribution_' . $type->id,
                        'label' => $type->name,
                        'type' => 'text',
                        'default' => ! empty($previous[$type->id]) ? $previous[$type->id]['name'] : __('Type and select the rattery’s name or prefix here...')
                    ]);

                    echo $this->Form->control('rattery_id_contribution_' . $type->id, [
                        'id' => 'jquery-rattery-id-' . $type->id,
                        'name' => 'rattery_id_contribution_' . $type->id,
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for rattery ID'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                        'default' => ! empty($previous[$type->id]) ? $previous[$type->id]['id'] : null
                    ]);
                ?>

            <?php endforeach ; ?>
            </fieldset>
            <?= $this->Form->button(__('Update Contributions')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

<?php $this->append('css');?>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<?php $this->end();?>
<?= $this->Html->css('statebar.css') ?>
<?= $this->Html->css('ajax.css') ?>

<?php $this->append('script');?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
    // autocomplete for rattery
    $(function () {
        $('#jquery-rattery-input-1').autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: '/ratteries/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-rattery-input-1').val(),
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
                $("#jquery-rattery-input-1").val(ui.item.value); // display the selected text
                $("#jquery-rattery-id-1").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-rattery-input-2").on("input", function(){
            $("#jquery-rattery-id-2").val('');
        });

        $('#jquery-rattery-input-2').autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: '/ratteries/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-rattery-input-2').val(),
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
                $("#jquery-rattery-input-2").val(ui.item.value); // display the selected text
                $("#jquery-rattery-id-2").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-rattery-input-3").on("input", function(){
            $("#jquery-rattery-id-3").val('');
        });

        $('#jquery-rattery-input-3').autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: '/ratteries/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-rattery-input-3').val(),
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
                $("#jquery-rattery-input-3").val(ui.item.value); // display the selected text
                $("#jquery-rattery-id-3").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-rattery-input-4").on("input", function(){
            $("#jquery-rattery-id-4").val('');
        });

        $('#jquery-rattery-input-4').autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: '/ratteries/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-rattery-input-4').val(),
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
                $("#jquery-rattery-input-4").val(ui.item.value); // display the selected text
                $("#jquery-rattery-id-4").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-rattery-input-4").on("input", function(){
            $("#jquery-rattery-id-4").val('');
        });
    });
    </script>
<?php $this->end(); ?>
