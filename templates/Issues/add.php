<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar', isset($help_url) ? $help_url : ['controller' => 'Faqs', 'action' => 'all']) ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => $url,
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back') ?></span>
                </div>
            </diV>
    </aside>
    <div class="column-responsive column-90">
        <div class="issues form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Issues') ?></div>
            </div>
            <h1><?=__('Report an issue') ?></h1>
            <?= $this->Form->create($issue) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('full_url', ['label' => __('Page'), 'value' => $this->Url->build($url, ['fullBase' => true]), 'readonly' => true]);
                    echo $this->Form->hidden('url', ['value' => $url, 'readonly' => true]);
                    echo $this->Form->control('complaint', ['label' => __('What is wrong with this page?'), 'default' => ' ']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit issue')) ?>
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
