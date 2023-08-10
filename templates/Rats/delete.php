<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
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
                        'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Back to rat sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Delete Sheet of') ?></div>
            </div>

            <h1><?= $rat->usual_name ?> (<?= $rat->pedigree_identifier ?>)</h1>

            <?= $this->Flash->render(); ?>

            <?php
            echo $this->Form->create(null, [
            	'id' => 'jquery-owner-form',
            ]); ?>

            <?php if ($count != 0) : ?>
                <fieldset>
                    <?php
                        echo $this->Form->control('searchkey', [
                            'id' => 'jquery-rat-input',
                            'name' => 'new_rat_name',
                            'label' => __('Search and select the heir’s name or identifier (must have the same birth date)'),
                            'type' => 'text',
                            'required' => $count != 0,
                            'placeholder' => __('Type here...'),
                        ]);
                        echo $this->Form->control('searchid', [
                            'id' => 'jquery-rat-id',
                            'name' => 'new_rat_id',
                            'label' => [
                                'class' => 'hide-everywhere',
                                'text' => 'Hidden field for ID update'
                            ],
                            'class' => 'hide-everywhere',
                            'type' => 'text',
                        ]);

                        echo $this->Form->control('cascade_delete', [
                            'type' => 'checkbox',
                            'label' => __('Click here to delete related messages and snapshots (only offspring will be transferred)')
                        ]);
                    ?>
                </fieldset>
            <?php endif; ?>
            <?= $this->Form->button(__('Delete rat sheet'), ['class' => 'button-staff', 'confirm' => __('Are you sure you want to delete # {0}?', [$rat->id])]); ?>
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
    $(function () {
        $('#jquery-rat-input')
            .on('input', function() {
                $("#jquery-rat-id").val('');
                if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                    $(this).removeClass('autocompleted');
                }
            })
            .autocomplete({
                minLength: 3,
                source: function (request, response) {
                    $.ajax({
                        url: '/rats/autocomplete.json',
                        dataType: 'json',
                        data: {
                            'searchkey': $('#jquery-rat-input').val(),
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
                    $("#jquery-rat-input").val(ui.item.value); // display the selected text
                    $("#jquery-rat-input").addClass("autocompleted"); // display the selected text
                    $("#jquery-rat-id").val(ui.item.id); // save selected id to hidden input
                }
            });
    });
    </script>
<?php $this->end(); ?>
