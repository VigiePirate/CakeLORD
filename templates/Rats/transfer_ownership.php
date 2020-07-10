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
                <div class="sheet-title pretitle"><?= __('Change Owner of ') ?></div>
            </div>

            <h1><?= $rat->usual_name . ' (' . $rat->pedigree_identifier . ')' ?></h1>

            <?php
            echo $this->Form->create($rat, [
            	'id' => 'jquery-owner-form',
            ]); ?>
            <fieldset>
                <div class="message default">
                    If the new owner is not registered on LORD, please type and select: <strong>Unregistered.</strong>
                </div>
                <?php
                    echo $this->Form->control('searchkey', [
                        'id' => 'jquery-owner-input',
                        'name' => 'owner_user_name',
                        'label' => __('Search and select new owner username'),
                        'type' => 'text',
                        'placeholder' => __('Type here...')
                    ]);
                    echo $this->Form->control('searchid', [
                        'id' => 'jquery-owner-id',
                        'name' => 'owner_user_id',
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for ID update'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                    ]);
                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Append comments (if needed)'),
                        'value' => $rat->comments,
                        'rows' => '5',
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Transfer ownership')); ?>
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
                $("#jquery-owner-input").val(ui.item.value); // display the selected text
                $("#jquery-owner-id").val(ui.item.id); // save selected id to hidden input
                console.log(ui.item);
            }
        });
        $('#mybutton').click(function() {
            alert($("#jquery-owner-id").val()); // get the id from the hidden input
        });
    });
    </script>
<?php $this->end();
