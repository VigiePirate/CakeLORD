<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->assign('title', __('Contact')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Help') ?></div>
            </div>

            <h1><?= __('Contact us') ?></h1>

            <?= $this->Flash->render(); ?>

            <?php echo $this->Form->create(null, ['type' => 'post', 'url' => ['action' => 'acknowledge']]); ?>

            <fieldset>
            <?php
                echo $this->Form->control('initiator_email', [
                    'label' => __('Your email address'),
                    'type' => 'email',
                    'required' => true,
                ]);

                echo $this->Form->control('email_content', [
                    'name' => 'email_content',
                    'label' => __('Your message'),
                    'rows' => '10',
                ]);
            ?>

            <?= $this->Form->control('captcha', [
                'label' => __('What is the meaning of the letter "D" in the LORD acronym?'),
                'required' => true,
                ])
            ?>
            </fieldset>
            <?= $this->Form->button(__x('button', 'Send email')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
