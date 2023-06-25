<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery $rattery
 */
?>

<?php $this->assign('title', __('New Rattery') ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => 'javascript:history.back()',
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Back') ?></span>
                    </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Ratteries') ?></div>
            </div>
            <h1><?=__('Record a new rattery') ?></h1>

            <?= $this->Flash->render() ?>

            <?= $this->Form->create($rattery, ['type' => 'file']) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('prefix');
                    echo $this->Form->control('name');

                    echo $this->Form->control('owner_username', [
                        'id' => 'jquery-owner-input',
                        'name' => 'owner_username',
                        'label' => __('Owner'),
                        'type' => 'text',
                        'placeholder' => __('Type here...'),
                        'empty' => true,
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
                    ]);

                    echo $this->Form->control('birth_year', __('Creation year'));
                    echo $this->Form->control('is_alive');
                    echo $this->Form->control('is_generic');
                    echo $this->Form->control('district', __('Localization (region, district, city...)'));
                    echo $this->Form->control('zip_code');
                    echo $this->Form->control('country_id', ['options' => $countries]);
                    echo $this->Form->control('website', __x('long', 'Website'));

                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Comments'),
                        'rows' => '5',
                        "error" => [
                            "escape" => false
                        ]
                    ]);

                    echo $this->Form->control('wants_statistic', __('Show statistics'));
                    echo $this->Form->control('picture_file', [
                        'type' => 'file',
                        'label' => __('Logotype')
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
