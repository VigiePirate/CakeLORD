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
            'alt' => __('Edit in database')]) ?>
        <span class="tooltiptext-staff"><?= __('Edit in database') ?></span>
    </div>
    <?php else : ?>
        <div class="tooltip disabled">
            <?= $this->Html->image('icon-edit-as-staff.svg', [
                'url' => [],
                'class' => 'side-nav-icon',
                'alt' => __('Delete Sheet')]) ?>
            <span class="tooltiptext"><?= __('You cannot edit this sheet') ?></span>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (! is_null($user) &&  $user->can('delete', $object)) : ?>
    <div class="tooltip-staff">
        <?= $this->Form->postLink(
                $this->Html->image('/img/icon-delete.svg', [
                    'class' => 'side-nav-icon',
                    'alt' => __('Delete Sheet')
                ]),
                ['action' => 'delete', $object->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $object->id),
                    'escape' => false
                ]
            )
        ?>
        <span class="tooltiptext-staff"><?= __('Delete') ?></span>
    </div>
<?php else : ?>
    <div class="tooltip disabled">
        <?= $this->Html->image('/img/icon-delete.svg', [
            'url' => [],
            'class' => 'side-nav-icon',
            'alt' => __('Delete Sheet')]) ?>
        <span class="tooltiptext"><?= __('You cannot delete this sheet') ?></span>
    </div>
<?php endif; ?>
