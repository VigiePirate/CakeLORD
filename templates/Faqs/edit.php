<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
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
                        'url' => ['controller' => 'Faqs', 'action' => 'view', $faq->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'FAQs', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All FAQs')]) ?>
                    <span class="tooltiptext"><?= __('See FAQ list') ?></span>
                </div>
            </div>

            <div class="side-nav-group">
                <div class="tooltip-staff">
                    <?= $this->Html->image('/img/icon-delete.svg', [
                        'class' => 'side-nav-icon',
                        'alt' => __('Delete FAQ')]) ?>
                    <span class="tooltiptext-staff"><?= __('Delete FAQ') ?></span>
                </div>
            </div>
        </div>
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
<?= $this->Html->css('from-md.css') ?>
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
