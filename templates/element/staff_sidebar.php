<div class="tooltip-staff">
    <?= $this->Html->image('/img/icon-edit-as-staff.svg', [
        'url' => ['controller' => $controller, 'action' => 'edit', $object->id],
        'class' => 'side-nav-icon',
        'alt' => __('Edit in database')]) ?>
    <span class="tooltiptext-staff"><?= __('Edit in database') ?></span>
</div>

<div class="tooltip-staff">
    <?= $this->Html->image('/img/icon-delete.svg', [
        'class' => 'side-nav-icon',
        'alt' => __('Delete entry')]) ?>
    <span class="tooltiptext-staff"><?= __('Delete entry') ?></span>
</div>
