<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => $Varieties,
                'object' => $variety,
                'tooltip' => $tooltip,
                'show_staff' => false
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="coats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __($Varieties) ?></div>
            </div>
            <h1><?= __('Add') . ' ' . $Variety ?></h1>
            <?= $this->Form->create($variety) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('genotype');
                    echo $this->Form->control('description', [
                        'type'=> 'textarea',
                        'id' => 'description',
                        'name' => 'description',
                        'default' => ' '
                    ]);
                    echo $this->Form->control('is_picture_mandatory', ['label' => __('Mandatory picture?')]);
                ?>
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
            "heading", "|",
            "bold", "italic", "strikethrough", "|",
            "unordered-list", "ordered-list", "table", "|",
            "link", "image", "|",
            "side-by-side", "fullscreen", "preview", "|",
            "guide"
        ]
    });
    easyMDE.toggleSideBySide();
</script>
