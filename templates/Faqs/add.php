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
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Faqs', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All FAQs')]) ?>
                    <span class="tooltiptext"><?= __('See all FAQs') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="faqs form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Frequently asked questions') ?></div>
            </div>
            <h1><?= __('Add an FAQ') ?></h1>
            <?= $this->Form->create($faq) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('category_id', ['options' => $categories]);
                    echo $this->Form->control('question');
                    echo $this->Form->control('answer', [
                        'type'=> 'textarea',
                        'id' => 'answer',
                        'name' => 'answer',
                        'default' => ' ' ]);
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
        previewImagesInEditor: true,
        promptURLs: true,
        sideBySideFullscreen: false,
        toolbar: [
            "bold", "italic", "strikethrough", "|",
            "unordered-list", "ordered-list", "table", "|",
            "link", "image", "|",
            "side-by-side", "fullscreen", "preview", "|",
            "guide"
        ]
    });
    easyMDE.toggleSideBySide();
</script>
