<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->assign('title', h($user->username)) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar', isset($help_url) ? $help_url : ['controller' => 'Faqs', 'action' => 'all']) ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('User') ?></div>
            </div>

            <h1><?= __('Add User') ?></h1>

            <?= $this->Form->create($user, ['type' => 'file']) ?>

            <fieldset>

                <?= $this->Form->control('username'); ?>
                <?= $this->Form->control('email'); ?>
                <?= $this->Form->control('password', ['label' => __('Password'), 'type' => 'password', 'required' => true, 'autofocus' => true]) ?>
                <?= $this->Form->control('role_id', ['options' => $roles]); ?>
                <div class="row">
                    <div class="column-responsive column-20">
                        <?= $this->Form->control('birth_date', ['empty' => true]) ?>
                    </div>
                    <div class="column-responsive column-40">
                        <?= $this->Form->control('firstname') ?>
                    </div>
                    <div class="column-responsive column-40">
                        <?= $this->Form->control('lastname') ?>
                    </div>
                </div>
                <?php
                    echo $this->Form->control('localization', ['label' => __('Localization (region, district, city...)')]);
                    echo $this->Form->control('about_me', [
                        'type' => 'textarea',
                        'id' => 'about_me',
                        'name' => 'about_me',
                        'label' => __('Public comments'),
                        'value' => $user->about_me,
                        'rows' => '5',
                    ]);

                    echo $this->Form->control('staff_comments', [
                        'type' => 'textarea',
                        'id' => 'staff_comments',
                        'name' => 'staff_comments',
                        'label' => __('Staff comments'),
                        'value' => $user->staff_comments,
                        'rows' => '5',
                    ]);

                    echo $this->Form->control('wants_newsletter', [
                        'label' => __('Accepts to receive casual newsletters and other information by email'),
                        'default' => false,
                    ]);

                    echo $this->Form->control('is_locked');
                    echo $this->Form->control('picture_file', ['label' => __('Avatar'), 'type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<?= $this->Html->script('easymde.min.js') ?>
<?= $this->Html->script('easymde-double.js') ?>
