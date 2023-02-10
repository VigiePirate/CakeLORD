<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('tech_sidebar', [
                    'controller' => 'Litters',
                    'object' => $litter,
                    'tooltip' => 'Browse Litter List',
                    'can_cancel' => true,
                    'show_staff' => $show_staff,
                    'user' => $user
                ])
            ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>
            <h1><?=__('Edit litter #') . $litter->id ?></h1>
            <?= $this->Form->setValueSources(['context', 'data'])->create($litter) ?>

            <?= $this->Flash->render() ?>

            <fieldset>
                <?= $this->Form->control('mating_date', ['empty' => true]) ?>

                <div class="row">
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pups_number', ['label' => __('Pups count')]) ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?= $this->Form->control('pups_number_stillborn', ['label' => __('Stillborn pups count')]); ?>
                    </div>
                </div>

                <?php
                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Comments'),
                        'rows' => '5',
                        "error" => [
                            "escape" => false
                        ]
                    ]);
                ?>

                <?=
                    $this->Form->control('rattery_id', [
                        'id' => 'jquery-rattery-id',
                        'name' => 'rattery_id',
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for rattery ID'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                        'value' => $litter->contributions[0]->rattery_id,
                    ]);
                ?>

                <?php if ($user->can('staffEdit', $litter)) : ?>
                    <h2 class="staff"><?= __('Staff-only') ?></h2>

                    <?= $this->Form->control('birth_date') ?>

                    <div class="row">
                        <div class="column-responsive column-50">
                            <?php
                                echo $this->Form->control('mother_name', [
                                    'id' => 'jquery-mother-input',
                                    'name' => 'mother_name',
                                    'label' => __('Mother'),
                                    'value' => $mother['name'],
                                ]);
                                echo $this->Form->control('mother_id', [
                                    'id' => 'jquery-mother-id',
                                    'name' => 'mother_id',
                                    'label' => [
                                        'class' => 'hide-everywhere',
                                        'text' => 'Hidden field for mother ID'
                                    ],
                                    'class' => 'hide-everywhere',
                                    'type' => 'text',
                                    'value' => $mother['id'],
                                ]);
                            ?>
                        </div>
                        <div class="column-responsive column-50">
                            <?php
                                    echo $this->Form->control('father_name', [
                                        'id' => 'jquery-father-input',
                                        'name' => 'father_name',
                                        'label' => __('Father'),
                                        'value' => $father['name'],
                                    ]);
                                    echo $this->Form->control('father_id', [
                                        'id' => 'jquery-father-id',
                                        'name' => 'father_id',
                                        'label' => [
                                            'class' => 'hide-everywhere',
                                            'text' => 'Hidden field for father ID'
                                        ],
                                        'class' => 'hide-everywhere',
                                        'type' => 'text',
                                        'value' => $father['id'],
                                    ]);
                                ?>
                        </div>
                    </div>
                <?php endif ; ?>
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
        $('#jquery-mother-input').autocomplete({
            minLength: 4,
            source: function (request, response) {
                $.ajax({
                    /*url: $('#jquery-owner-form').attr('action') + '.json',*/
                    url: '/rats/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-mother-input').val(),
                        'sex': 'F',
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
                $("#jquery-mother-input").val(ui.item.value); // display the selected text
                $("#jquery-mother-id").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-mother-input").on("input", function(){
            $("#jquery-mother-id").val('');
        });
    });
    </script>
    <script>
    // autocomplete for father
    $(function () {
        $('#jquery-father-input').autocomplete({
            minLength: 4,
            source: function (request, response) {
                $.ajax({
                    /*url: $('#jquery-owner-form').attr('action') + '.json',*/
                    url: '/rats/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-father-input').val(),
                        'sex': 'M',
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
                $("#jquery-father-input").val(ui.item.value); // display the selected text
                $("#jquery-father-id").val(ui.item.id); // save selected id to hidden input
            }
        });

        $("#jquery-father-input").on("input", function(){
            $("#jquery-father-id").val('');
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
