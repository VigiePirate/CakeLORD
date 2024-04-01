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
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Users', 'action' => 'view', $user->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to user sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Send email to') ?></div>
            </div>

            <h1><?= h($user->username) ?></h1>

            <?php echo $this->Form->create(null, ['type' => 'post']); ?>

            <?php
                echo $this->Form->control('email_content', [
                    'name' => 'email_content',
                    'label' => '',
                    'rows' => '5',
                ]);
            ?>

            <?= $this->Form->button(__x('button', 'Send email')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<?= $this->Html->script('easymde.min.js') ?>
<?= $this->Html->script('easymde-light.js') ?>
