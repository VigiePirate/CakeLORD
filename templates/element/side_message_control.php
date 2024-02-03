<!-- must be included between calls to Form->create() and Form->end() -->

<?php if (isset($user) && ! is_null($user)) : ?>

    <!-- only visible to staff members when editing a sheet in a state not needing user action -->
    <?php if (! $sheet->state->needs_user_action && $user->can('changeState', $sheet)) : ?>
        <?php if (isset($legend)) : ?>
            <legend><?= h($legend) ?></legend>
        <?php endif; ?>

        <?php
            echo $this->Form->control('side_message', [
                'type' => 'textarea',
                'name' => 'side_message',
                'label' => isset($label) ? $label : __('Explain staff intervention'),
                'rows' => '5',
                'required' => isset($required) ? false : true,
            ]);
        ?>

        <p class="sub-legend tight-legend"><?= __('Explanation is optional. If provided, it will be included in a notification visible to all stakeholders.') ?></p>

    <?php endif ;?>

    <!-- only visible to sheet stakeholder when editing a sheet in a state needing user action -->
    <?php if ($user->can('ownerEdit', $sheet) && $sheet->state->needs_user_action) : ?>
        <?php
            echo $this->Form->control('side_message', [
                'type' => 'textarea',
                'name' => 'side_message',
                'label' => isset($label) ? $label : __('Optional private notification'),
                'rows' => '5',
                'required' => isset($required) ? false : true, // user explanation is mandatory by default
            ]);
        ?>

        <p class="sub-legend tight-legend"><?=
            isset($required)
            ? __('You can add here a request or message. If provided, it will be included in a notification visible to all stakeholders.')
            : __('Answer is mandatory. It will be included in a notification visible to all stakeholders.')
            ?>
        </p>

    <?php endif ;?>

<?php endif ; ?>
