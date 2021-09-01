<div class="spacer"> </div>

<div class="tooltip-staff">
    <?= $this->Html->image('/img/icon-edit-as-staff.svg', [
        'url' => ['controller' => 'Rats', 'action' => 'edit', $rat->id],
        'class' => 'side-nav-icon',
        'alt' => __('Edit Rat as Admin')]) ?>
    <span class="tooltiptext-staff"><?= __('Edit rat data as staff') ?></span>
</div>

<div class="tooltip-staff">
    <?= $this->Html->image('/img/icon-delete.svg', [
        'class' => 'side-nav-icon',
        'alt' => __('Delete Rat')]) ?>
    <span class="tooltiptext-staff"><?= __('Delete rat') ?></span>
</div>
