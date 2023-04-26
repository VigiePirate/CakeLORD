<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
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
                        'url' => ['controller' => 'Users', 'action' => 'view', $user->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back to user sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('User') ?></div>
            </div>

            <h1><?= __('Edit {0}', [h($user->username)]) ?> </h1>

            <?= $this->Form->create($user, ['type' => 'file']) ?>

            <fieldset>
                <legend><?= __('Public information') ?></legend>
                <?= $this->Form->control('username'); ?>
                <?php if ($identity->can('promote', $user)) : ?>
                    <?= $this->Form->control('role_id', ['options' => $roles]); ?>
                <?php endif; ?>
                <?php
                    echo $this->Form->control('localization');
                    echo $this->Form->control('picture_file', ['label' => __('Avatar'), 'type' => 'file']);
                    echo $this->Form->control('about_me', [
                        'type' => 'textarea',
                        'id' => 'about_me',
                        'name' => 'about_me',
                        'label' => __('About me'),
                        'value' => $user->about_me,
                        'rows' => '5',
                    ]);
                ?>
                <?php if ($identity->can('accessPersonal', $user)) : ?>
                    <legend><?= __('Private information') ?></legend>
                    <?php if ($identity->id == $user->id) : ?>
                        <p class="helper">
                            <?= __('For security reasons, you cannot change your credentials here.') ?>
                            <br/>
                            <?= $this->Html->link(__('Change email'), ['action' => 'changeEmail'])
                            . ' — '
                            . $this->Html->link(__('Change password'), ['action' => 'changePassword']) ?>
                        </p>
                    <?php endif ; ?>

                    <div class="row">
                        <div class="column-responsive column-50">
                            <?= $this->Form->control('firstname') ?>
                        </div>
                        <div class="column-responsive column-50">
                            <?= $this->Form->control('lastname') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column-responsive column-50">
                            <?= $this->Form->control('birth_date', ['empty' => true]) ?>
                        </div>
                        <div class="column-responsive column-50">
                            <?= $this->Form->label('sex', __x('human', 'Sex')) ?>
                            <?= $this->Form->select('sex', [
                                'F' => __x('human', 'Female'),
                                'M' => __x('human', 'Male'),
                                'X' => __x('human', 'No thanks')
                            ]) ?>
                        </div>
                    </div>

                    <div class="spacer"></div>
                    <?= $this->Form->control('wants_newsletter', ['label' => __('I accept to receive casual newsletters and other information by email')]); ?>

                <?php endif; ?>

                <?php if ($identity->can('seeStaffOnly', $user)) : ?>
                    <legend><?= __('Staff-only information') ?></legend>
                        <?= $this->Form->control('email'); ?>
                        <?= $this->Form->control('is_locked'); ?>
                        <?= $this->Form->control('staff_comments', [
                            'type' => 'textarea',
                            'id' => 'staff_comments',
                            'name' => 'staff_comments',
                            'label' => __('Staff comments'),
                            'value' => $user->staff_comments,
                            'rows' => '5',
                        ]); ?>
                <?php endif; ?>
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
        element: document.getElementById('about_me'),
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
    var easyMDE2 = new EasyMDE({
        element: document.getElementById('staff_comments'),
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
    easyMDE2.toggleSideBySide();
</script>
