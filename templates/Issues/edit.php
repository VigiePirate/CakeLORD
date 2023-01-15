<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
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
                        'url' => ['controller' => 'Issues', 'action' => 'view', $issue->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Cancel and go back') ?></span>
                    </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Issues', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('List')]) ?>
                        <span class="tooltiptext"><?= __('Back to open issue list') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Issues',
                    'object' => $issue,
                    'can_cancel' => true,
                    'user' => $identity
                ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="issues view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Issues') ?></div>
            </div>

            <h1><?= __('Solve Issue #') . $issue->id ?></h1>

            <h2><?= __('Complaint') ?></h2>

            <table class="condensed">
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($issue->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('From User') ?></th>
                    <td><?= $this->Html->link($issue->from_user->username, ['controller' => 'Users', 'action' => 'view', $issue->from_user->id]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Page') ?></th>
                    <td><?= $this->Html->link(h($issue->url), $this->Url->build($issue->url, ['fullBase' => true]), ['target' => '_blank'])?></td>
                </tr>
                <tr>
                    <th class="comment-head"><?= __('Comment') ?></th>
                    <td class="comment"><?= $this->Commonmark->sanitize($issue->complaint); ?></td>
            </table>

            <h2><?= __('Handling') ?></h2>

            <?= $this->Form->create($issue) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('handling', ['label' => __('Enter answer')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Close issue')) ?>
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
