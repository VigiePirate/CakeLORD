<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery $rattery
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
                <div class="sheet-title pretitle"><?= __('Change Picture of ') ?></div>
            </div>

            <h1><?= h($user->username) ?></h1>

            <?= $this->Flash->render(); ?>

            <?php
                echo $this->Form->create($user, ['type' => 'file']); ?>
                <fieldset>
                    <?= $this->Form->control('picture_file', ['type' => 'file']) ?>
                </fieldset>
                <?= $this->Form->button(__('Upload picture'), ['name' => 'action', 'value' => 'upload']) ?>
                <?= $this->Form->button(__('Delete picture'), ['name' => 'action', 'value' => 'delete', 'class' => 'button-staff']) ?>
                <?= $this->Form->end();
            ?>
        </div>
    </div>
</div>
