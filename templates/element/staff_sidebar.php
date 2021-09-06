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

<!-- code for postlink delete -->
<!-- $this->Form->postLink(__('Delete coat'), ['action' => 'delete', $coat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coat->id), 'class' => 'side-nav-item']) */ -->
