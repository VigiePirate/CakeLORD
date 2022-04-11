<div class="tooltip-staff">
    <?= $this->Html->image('/img/icon-edit-as-staff.svg', [
        'url' => ['controller' => $controller, 'action' => 'edit', $object->id],
        'class' => 'side-nav-icon',
        'alt' => __('Edit in database')]) ?>
    <span class="tooltiptext-staff"><?= __('Edit in database') ?></span>
</div>

<div class="tooltip-staff">
    <?= $this->Form->postLink(
            $this->Html->image('/img/icon-delete.svg', [
                'class' => 'side-nav-icon',
                'alt' => __('Delete Article')
            ]),
            ['action' => 'delete', $object->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $object->id), 'escape' => false]
        )
    ?>
    <span class="tooltiptext-staff"><?= __('Delete') ?></span>
</div>
