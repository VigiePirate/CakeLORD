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
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Ratteries', 'action' => 'view', $rattery->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to rattery sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Edit Comments of ') ?></div>
                <div class="tooltip-state">
                    <div class="current-statemark statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></div>
                    <span class="tooltiptext-state hide-on-mobile"><?= h($rattery->state->name) ?></span>
                </div>
            </div>

            <h1><?= h($rattery->full_name) . '<span class="rotate"> ' . h($rattery->is_inactive_symbol) . '</span>'?></h1>

            <?php echo $this->Form->create($rattery); ?>

            <?php
                echo $this->Form->control('comments', [
                    'name' => 'comments',
                    'label' => '',
                    'value' => $rattery->comments,
                    'rows' => '5',
                    "error" => [
                        "escape" => false
                    ]
                ]);
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
