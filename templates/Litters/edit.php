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

            <?php if (! $user->can('staffEdit', $litter)) : ?>
                <div class="message warning">
                    <?= __('In order to ensure data consistence, modifications of litter data are restricted. Please, contact a staff member if you want to edit the litter’s parents or birth date.') ?>
                </div>
            <?php endif ; ?>

            <fieldset>
                <?php
                    echo $this->Form->control('mating_date', ['empty' => true]);

                    echo $this->Form->control('pups_number', ['label' => __('Born-alive pups count')]);
                    echo $this->Form->control('pups_number_stillborn', ['label' => __('Stillborn pups count')]);

                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Comments'),
                        'rows' => '5',
                        "error" => [
                            "escape" => false
                        ]
                    ]);
                ?>
                <?php if ($user->can('staffEdit', $litter)) : ?>
                    <h2 class="staff"><?= __('Staff-only') ?></h2>

                    <?php
                        echo $this->Form->control('birth_date');
                        echo $this->Form->control('creator_user_id', ['options' => $users]);
                        echo $this->Form->control('state_id', ['options' => $states]);
                    ?>
                <?php endif ; ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

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
