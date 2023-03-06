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
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>

            <h1><?= __('Attach rat to litter: #{0}', [$litter->id]) ?></h1>

            <p><label><?= __('The rat you will select will be attached to the following litter: ')?>
                <?= $this->Html->link(h($litter->full_name), ['controller' => 'Litters', 'action' => 'view', $litter->id]); ?></label>
            </p>

            <?php echo $this->Form->create(); ?>
            <fieldset>
                <?php
                    echo $this->Form->control('rat_name', [
                        'id' => 'jquery-rat-input',
                        'name' => 'rat_name',
                        'label' => __('Rat'),
                        'type' => 'text',
                        'placeholder' => __('Type and select the rat’s name or identifier here...'),
                    ]);
                    echo $this->Form->control('rat_id', [
                        'id' => 'jquery-rat-id',
                        'name' => 'rat_id',
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for rat ID'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                    ]);

                echo $this->Form->control('update_identifier', [
                    'label' => ['text' => __('Update pedigree identifier?')],
                    'type' => 'checkbox',
                    'default' => false,
                ]);
            ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
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
        $('#jquery-rat-input').autocomplete({
            minLength: 4,
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
                $("#jquery-rat-id").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-rat-input").on("input", function(){
            $("#jquery-rat-id").val('');
        });
    });
    </script>
<?php $this->end(); ?>
