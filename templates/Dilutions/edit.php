<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dilution $dilution
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Dilutions',
        'Variety' => __('Dilution'),
        'variety' => $dilution,
        'tooltip' => __('Browse dilution list'),
        'show_staff' => true
    ])
?>

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
