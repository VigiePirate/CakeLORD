<!-- must be included between calls to Form->create() and Form->end() -->

<?php if (isset($user) && ! is_null($user)) : ?>

    <!-- special tag to deal with staff acting as owners -->
    <?php if (! isset($ignore_staff)) : $ignore_staff = false ; endif ; ?>

    <!-- only visible to staff members when editing a sheet in a state not needing user action -->
    <?php if (! $sheet->state->needs_user_action && $user->can('changeState', $sheet) && ! $ignore_staff) : ?>
        <?php if (isset($legend)) : ?>
            <legend><?= h($legend) ?></legend>
        <?php endif; ?>

        <?php
            echo $this->Form->control('side_message', [
                'type' => 'textarea',
                'name' => 'side_message',
                'label' => isset($label) ? $label : __('Explain staff intervention'),
                'rows' => '5',
                'required' => isset($required) ? $required : false,
            ]);
        ?>

        <p class="sub-legend tight-legend"><?= __('Explanation is optional. If provided, it will be included in a notification visible to all stakeholders.') ?></p>

    <?php endif ;?>

    <!-- only visible to sheet stakeholder when editing a sheet in a state needing user action -->
    <?php if ($ignore_staff || ($sheet->state->needs_user_action && $user->can('ownerEdit', $sheet))) : ?>
        <?php
            echo $this->Form->control('side_message', [
                'type' => 'textarea',
                'name' => 'side_message',
                'label' => isset($label) ? $label : __('Add a message for staff'),
                'rows' => '5',
                'required' => isset($required) ? $required : false,
            ]);
        ?>

        <p class="sub-legend tight-legend"><?=
            isset($required) && $required
            ? __('Answer is mandatory. It will be included in a notification visible to all stakeholders.')
            : __('Answer is optional. If provided will be included in a notification visible to all stakeholders.')
            ?>
        </p>

    <?php endif ;?>

<?php endif ; ?>
