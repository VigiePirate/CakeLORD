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
                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Edit Comments of ') ?></div>
                <div class="tooltip-state">
                    <div class="current-statemark statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></div>
                    <span class="tooltiptext-state hide-on-mobile"><?= h($litter->state->name) ?></span>
                </div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <?php echo $this->Form->create($litter); ?>

            <?php
                echo $this->Form->control('comments', [
                    'name' => 'comments',
                    'label' => '',
                    'value' => $litter->comments,
                    'rows' => '5',
                    "error" => [
                        "escape" => false
                    ]
                ]);
            ?>

            <!-- Hidden fields for compatibility with lifecycle -->
            <?php
                echo $this->Form->control('rattery_id', [
                    'name' => 'rattery_id',
                    'label' => [
                        'class' => 'hide-everywhere',
                        'text' => 'Hidden field for rattery ID'
                    ],
                    'class' => 'hide-everywhere',
                    'type' => 'text',
                    'value' => $litter->contributions[0]->rattery_id,
                ]);

                for ($k = 0; $k <= count($litter->contributions)-1; $k++) {
                    echo $this->Form->control('contributions.'.$k.'.id', [
                        'type' => 'hidden',
                        'value' => $litter->contributions[$k]->id,
                    ]);

                    echo $this->Form->control('contributions.'.$k.'.contribution_type_id', [
                        'type' => 'hidden',
                        'value' => $litter->contributions[$k]->contribution_type_id,
                    ]);

                    echo $this->Form->control('contributions.'.$k.'.rattery_id', [
                        'type' => 'hidden',
                        'value' => $litter->contributions[$k]->rattery_id,
                    ]);
                }
            ?>

            <?= $this->Form->button(__('Save comment')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>

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
