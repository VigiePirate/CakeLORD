<!-- must be included between calls to Form->create() and Form->end() -->
<!-- only visible to staff members when editing a sheet in a state needing staff action -->

<?php if (isset($user) && ! is_null($user) && $user->can('staffEdit', $sheet)) : ?>

    <?php if (isset($legend)) : ?>
        <legend><?= h($legend) ?></legend>
    <?php endif; ?>

    <?php
        echo $this->Form->control('side_message', [
            'type' => 'textarea',
            'name' => 'side_message',
            'label' => isset($label) ? $label : __('Explain staff intervention'),
            'rows' => '5'
        ]);
    ?>

    <p class="sub-legend"><?= __('Explanation is optional. If provided, it will be included in a notification visible to all stakeholders.') ?></p>
<?php endif ; ?>
