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
            <?= $this->Html->link(__('List Rats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle">Rats</div>
            </div>
            <h1><?= __('Advanced search') ?></h1>

            <div class="message default">
                Please fill in your search criteria below. You can leave empty the criteria you do not want to use.
            </div>

            <?php echo $this->Form->create($rat, [
            	'id' => 'jquery-search-form',
            ]); ?>
            <fieldset>
                <legend><?= __('Identity criteria') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('sex', ['type' => 'radio', 'options' => ['X' => 'Any', 'F' => 'Female', 'M' => 'Male']]);

                    // Search rattery with autocomplete
                    echo $this->Form->control('ratterykey', [
                        'id' => 'jquery-rattery-input',
                        'name' => 'rattery_name',
                        'label' => __('Origin'),
                        'type' => 'text',
                        'placeholder' => __('Type here...')
                    ]);
                    echo $this->Form->control('ratteryid', [
                        'id' => 'jquery-rattery-id',
                        'name' => 'rattery_id',
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for rattery ID'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                    ]);

                    // Search owner with autocomplete
                    echo $this->Form->control('ownerkey', [
                        'id' => 'jquery-owner-input',
                        'name' => 'owner_user_name',
                        'label' => __('Owner'),
                        'type' => 'text',
                        'placeholder' => __('Type here...')
                    ]);
                    echo $this->Form->control('ownerid', [
                        'id' => 'jquery-owner-id',
                        'name' => 'owner_user_id',
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for owner ID'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                    ]);

                    echo $this->Form->control('birth_date_before', ['type' => 'date', 'label' => 'Born before...']);
                    echo $this->Form->control('birth_date_after', ['type' => 'date', 'label' => 'Born after...']);
                    echo $this->Form->control('is_alive');
                ?>
                <legend><?= __('Physical criteria') ?></legend>
                <?php
                    echo $this->Form->control('color_id', ['empty' => true, 'default' => 0,'options' => $colors]);
                    echo $this->Form->control('eyecolor_id', ['empty' => true, 'default' => 0, 'options' => $eyecolors]);
                    echo $this->Form->control('dilution_id', ['empty' => true, 'default' => 0, 'options' => $dilutions]);
                    echo $this->Form->control('marking_id', ['empty' => true, 'default' => 0, 'options' => $markings]);
                    echo $this->Form->control('earset_id', ['empty' => true, 'default' => 0, 'options' => $earsets]);
                    echo $this->Form->control('coat_id', ['empty' => true, 'default' => 0, 'options' => $coats]);
                    echo $this->Form->control('singularities._ids', ['empty' => true, 'default' => 0, 'options' => $singularities, 'size' => '13', 'style' => 'height:auto;']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Script for owner search -->
<?php $this->append('css');?>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<?php $this->end();?>
<?= $this->Html->css('ajax.css') ?>
<?php $this->append('script');?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
    });
    </script>
    <script>
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
    });
    </script>
<?php $this->end();
