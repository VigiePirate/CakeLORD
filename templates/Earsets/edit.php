<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earset $earset
 */
?>
<?= $this->element('variety/edit', [
        'Varieties' => 'Earsets',
        'Variety' => __('Earset'),
        'variety' => $earset,
        'tooltip' => __('Browse earset list'),
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
