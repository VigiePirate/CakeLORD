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
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to rat sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Change Owner of ') ?></div>
                <div class="tooltip-state">
                    <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                    <span class="tooltiptext-state hide-on-mobile"><?= h($rat->state->name) ?></span>
                </div>
            </div>

            <h1><?= $rat->usual_name . ' (' . $rat->pedigree_identifier . ')' ?></h1>

            <?php
            echo $this->Form->create($rat, [
            	'id' => 'jquery-owner-form',
            ]); ?>
            <fieldset>
                <div class="message default">
                    <?= __('If the new owner is not registered on LORD, please type and select: <strong>Unregistered.</strong>') ?>
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

<?= $this->Html->css('statebar.css') ?>

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
        $('#mybutton').click(function() {
            alert($("#jquery-owner-id").val()); // get the id from the hidden input
        });
    });
    </script>
<?php $this->end();
