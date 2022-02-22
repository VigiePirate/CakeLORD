<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
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
                        'url' => ['controller' => 'Articles', 'action' => 'view', $article->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Articles', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All articles')]) ?>
                    <span class="tooltiptext"><?= __('See all articles') ?></span>
                </div>
            </div>

            <div class="side-nav-group">
                <div class="tooltip-staff">
                    <?= $this->Html->image('/img/icon-delete.svg', [
                        'class' => 'side-nav-icon',
                        'alt' => __('Delete Article')]) ?>
                    <span class="tooltiptext-staff"><?= __('Delete article') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="articles form content">
            <h1><?= __('Edit Article') ?></h1>
            <?= $this->Form->create($article) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('category_id', ['options' => $categories]);
                    echo $this->Form->control('subtitle', ['label' => __('Overtitle')]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('content', [
                        'type'=> 'textarea',
                        'id' => 'content',
                        'name' => 'content',
                        'default' => $article->content ]);
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
