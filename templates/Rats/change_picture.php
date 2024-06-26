<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->assign('title', h($rat->usual_name)) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to rat sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Change Picture of ') ?></div>
                <div class="tooltip-state">
                    <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                    <span class="tooltiptext-state hide-on-mobile"><?= h($rat->state->name) ?></span>
                </div>
            </div>

            <h1><?= $rat->usual_name . ' (' . $rat->pedigree_identifier . ')' ?></h1>

            <?= $this->Flash->render(); ?>

            <?php echo $this->Form->create($rat, ['type' => 'file']); ?>

            <fieldset>
                <?= $this->Form->control('picture_file', ['label' => __('Photo'), 'type' => 'file']) ?>
                <?= $this->element('side_message_control', ['sheet' => $rat]) ?>
            </fieldset>

            <div class="row-hfill">
                <div><?= $this->Form->button(__('Upload picture'), ['name' => 'action', 'value' => 'upload']) ?></div>
                <div><?= $this->Form->button(__('Delete picture'), ['name' => 'action', 'value' => 'delete', 'class' => 'button-staff']) ?></div>
            </div>

            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
