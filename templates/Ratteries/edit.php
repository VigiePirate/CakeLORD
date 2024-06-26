<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery $rattery
 */
?>
<?php $this->assign('title', h($rattery->full_name)) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('tech_sidebar', [
                    'controller' => 'Ratteries',
                    'object' => $rattery,
                    'tooltip' => 'Browse Rattery List',
                    'can_cancel' => true,
                    'show_staff' => $show_staff,
                    'user' => $user,
                    'help_url' => ['controller' => 'Articles', 'action' => 'view', 29]
                ])
            ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Ratteries') ?></div>
            </div>
            <h1><?=__('Edit {0}', [h($rattery->full_name)]) ?></h1>
            <?= $this->Form->setValueSources(['context', 'data'])->create($rattery, ['type' => 'file']) ?>
            <fieldset>
                <?php if ($user->can('staffEdit', $rattery)) : ?>
                    <?= $this->Form->control('prefix'); ?>
                <?php else : ?>
                    <?= $this->Form->control('prefix', ['readonly' => true]); ?>
                <?php endif ;?>

                <?php
                    echo $this->Form->control('name');

                    echo $this->Form->control('owner_username', [
                        'id' => 'jquery-owner-input',
                        'name' => 'owner_username',
                        'label' => __('Owner'),
                        'type' => 'text',
                        'placeholder' => __('Type here...'),
                        'empty' => true,
                        'value' => $rattery->user->username,
                    ]);
                    echo $this->Form->control('owner_user_id', [
                        'id' => 'jquery-owner-id',
                        'name' => 'owner_user_id',
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for owner ID'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                        'empty' => true,
                        'value' => $rattery->user_id,
                    ]);

                    echo $this->Form->control('birth_year', ['label' => __('Creation year')]);
                    echo $this->Form->control('district', ['label' => __('Localization (region, district, city...)')]);
                    echo $this->Form->control('zip_code', ['label' => __('Zipcode (will be used in rattery map)')]);
                    echo $this->Form->control('country_id', ['options' => $countries]);
                    echo $this->Form->control('website', ['label' => __x('long', 'Website')]);

                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Comments'),
                        'rows' => '5',
                        "error" => [
                            "escape" => false
                        ]
                    ]);

                    echo $this->Form->control('wants_statistic', ['label' => __('Check this box if you want to see and publish your statistics')]);
                    echo $this->Form->control('is_alive', ['label' => __('Check this box if the rattery is active, uncheck it to declare it inactive')]);

                ?>

                <?php if ($show_staff) {
                    echo $this->Form->control('is_generic', ['label' => __('Check this box to declare the rattery as generic')]);
                    echo $this->Form->control('is_dam_required', ['label' => __('Check this box if rats with this prefix must have a declared mother')]);
                } ?>

                <?php
                    echo $this->Form->control('picture_file', [
                        'type' => 'file',
                        'label' => __('Logotype')
                    ]);
                    echo $this->element('side_message_control', ['sheet' => $rattery, 'user' => $user, 'required' => false]);
                ?>

            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->css('jquery.ui.css') ?>
<?= $this->Html->css('ajax.css') ?>
<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('jquery.ui.min.js') ?>

<script>
$(function() {
    $(window).on('load', function() {
        if (! $("#jquery-owner-id").val() == '') {
            $("#jquery-owner-input").addClass("autocompleted");
        }
    });
});
</script>

<script>
$(function () {
    $('#jquery-owner-input')
        .on('input', function() {
            $("#jquery-mother-id").val('');
            if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                $(this).removeClass('autocompleted');
            }
        })
        .autocomplete({
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
                $("#jquery-owner-input").addClass("autocompleted"); // display the selected text
                $("#jquery-owner-id").val(ui.item.id); // save selected id to hidden input
            }
        }
    );
});
</script>

<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<?= $this->Html->script('easymde.min.js') ?>
<?= $this->Html->script('easymde-light.js') ?>
