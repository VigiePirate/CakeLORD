<?php $this->assign('title', __('New Rattery')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'users', 'action' => 'my'],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back to dashboard') ?></span>
                </div>
            </diV>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries form content">
            <h1><?=__('Register your rattery') ?></h1>
            <?= $this->Flash->render() ?>
            <?= $this->Form->create($rattery, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Please enter your rattery information below') ?></legend>
                <?php
                    echo $this->Form->control('prefix', ['error' => ['The provided value is invalid' => __('This prefix is already in use')]]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('birth_year', ['label' => __('Creation year')]);
                    echo $this->Form->control('district', ['label' => __('Localization (region, district, city...)')]);
                    echo $this->Form->control('zip_code', ['label' => __('Zipcode (will be used in rattery map)')]);
                    echo $this->Form->control('country_id', ['options' => $countries]);
                    echo $this->Form->control('website', ['label' => __x('long', 'Website')]);

                    echo $this->Form->control('comments', [
                        'name' => 'comments',
                        'label' => __('Comments'),
                        'rows' => '5',
                        "error" => [
                            "escape" => false
                        ]
                    ]);

                    echo $this->Form->control('wants_statistic', ['label' => __('Check this box if you want to see and publish your statistics')]);
                    echo $this->Form->control('picture_file', ['label' => __('Logotype'), 'type' => 'file']);
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
            "unordered-list", "ordered-list", "table", "|",
            "link", "|",
            "side-by-side", "fullscreen", "preview", "|",
            "guide"
        ]
    });
    easyMDE.toggleSideBySide();
</script>
