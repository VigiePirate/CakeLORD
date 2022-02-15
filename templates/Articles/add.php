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
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Articles', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All articles')]) ?>
                    <span class="tooltiptext"><?= __('See all articles') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="articles form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Articles') ?></div>
            </div>
            <h1><?= __('Add Article') ?></h1>
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
