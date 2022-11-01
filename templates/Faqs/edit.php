<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Faqs',
                'object' => $faq,
                'tooltip' => __('See all FAQs'),
                'show_staff' => true,
                'user' => $user
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="faqs form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('FAQs') ?></div>
            </div>
            <h1><?= __('Edit FAQ') ?></h1>
            <?= $this->Form->create($faq) ?>
            <fieldset>

                <?php
                    echo $this->Form->control('category_id', ['options' => $categories]);
                    echo $this->Form->control('question');
                    echo $this->Form->control('answer');
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
            "bold", "italic", "strikethrough", "|",
            "unordered-list", "ordered-list", "|",
            "link", "|",
            "side-by-side", "fullscreen", "preview", "|",
            "guide"
        ]
    });
    easyMDE.toggleSideBySide();
</script>
