<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav">
                <?= $this->Html->image('/img/icon-fa-alert.svg', [
                    'url' => ['controller' => 'Conversations', 'action' => 'add'],
                    'class' => 'side-nav-icon',
                    'alt' => __('Report')]) ?>
                <?= $this->Html->image('/img/icon-help.svg', [
                    'url' => ['controller' => 'Articles', 'action' => 'index'],
                    'class' => 'side-nav-icon',
                    'alt' => __('Help')]) ?>
                <div class="spacer"> </div>
                <?= $this->Html->image('/img/icon-file-edit.svg', [
                    'url' => ['controller' => 'Rats', 'action' => 'edit', $rat->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Modify Rat')]) ?>
                    <?= $this->Html->image('/img/icon-fa-give.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'give', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Change Owner')]) ?>
                <?= $this->Html->image('/img/icon-fa-baby.svg', [
                    'url' => ['controller' => 'Litters', 'action' => 'add'], //pass rattery id as contributor ? $rattery->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Declare Litter')]) ?>
                    <?= $this->Html->image('/img/icon-rip.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'kill', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Declare Rat Death')]) ?>
                <div class="spacer"> </div>
                <?= $this->Html->image('/img/icon-edit-admin.svg', [
                    'url' => ['controller' => 'Rats', 'action' => 'edit', $rat->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Edit Rat as Admin')]) ?>
                <?= $this->Html->image('/img/icon-fa-trash.svg', [
                    'class' => 'side-nav-icon',
                    'alt' => __('Delete Rat')]) ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle">Rat</div>
                <div class="sheet-markers">
                    <div class="sexmark sexcolor_<?php echo h($rat->sex) ?>"><?= h($rat->sex_symbol) ?></div>
                    <div class="statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                </div>
            </div>
            <h1><?= h($rat->double_prefix) . ' '. h($rat->name) . '<span>' . h($rat->is_alive_symbol) . '</span>' ?></h1>
        </div>
    </div>
</div>
