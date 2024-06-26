<!-- if you can cancel, you cannot edit -->
<?php if (! isset($can_cancel) || ! $can_cancel) : ?>
    <?php
        if (
            ($object->has('state') && ! is_null($user) && $user->can('staffEdit', $object))
            || (! $object->has('state') && ! is_null($user) && $user->can('edit', $object))
        ): ?>
    <div class="tooltip-staff">
        <?= $this->Html->image('/img/icon-edit-as-staff.svg', [
            'url' => ['controller' => $controller, 'action' => 'edit', $object->id],
            'class' => 'side-nav-icon',
            'alt' => __('Edit as staff')]) ?>
        <span class="tooltiptext-staff"><?= __('Edit as staff') ?></span>
    </div>
    <?php else : ?>
        <div class="tooltip-staff disabled">
            <?= $this->Html->image('icon-edit-as-staff.svg', [
                'url' => [],
                'class' => 'side-nav-icon',
                'alt' => __('Edit')]) ?>
            <span class="tooltiptext-staff"><?= __('You cannot edit this sheet') ?></span>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (! is_null($user) &&  $user->can('delete', $object)) : ?>
    <div class="tooltip-staff">
        <?= $this->Html->image('icon-delete.svg', [
            'url' => ['action' => 'delete', $object->id],
            'class' => 'side-nav-icon',
            'alt' => __('Delete Sheet')]) ?>
        <span class="tooltiptext-staff"><?= __('Delete') ?></span>
    </div>

<?php else : ?>
    <div class="tooltip-staff disabled">
        <?= $this->Html->image('/img/icon-delete.svg', [
            'url' => [],
            'class' => 'side-nav-icon',
            'alt' => __('Delete Sheet')])
        ?>
        <span class="tooltiptext-staff"><?= __('You cannot delete this sheet') ?></span>
    </div>
<?php endif; ?>
