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
                    'user' => $user
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
            <?= $this->Form->setValueSources(['context', 'data'])->create($rattery) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('prefix', [
                        'readonly' => true
                    ]);

                ?>
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
                    echo $this->Form->control('wants_statistic', ['label' => __('Check this box if the rattery is active, uncheck it to declare it inactive')]);
                    echo $this->Form->control('is_generic', ['label' => __('Check this box to declare the rattery as generic')]);
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
