<!-- ugly style to be replaced later by state->css_property -->

<div class="sheet-markers">
    <!-- if guest or non-staff user, show only current state -->

    <!-- else, if user is a staff member, show full state bar -->

    <!-- if state is not frozen -->
    <?php if() : ?>
    <!-- if state doesn't need staff action: show next ko, next frozen -->
        <?php if() : ?>
        <!-- if state needs staff action: show newt frozen, next ko, next ok -->
        <?php else : ?>

        <?php endif; ?>

    <!-- if state is frozen, show next thawed in the right order (using is reliable) -->
    <?php else : ?>


    <?php endif; ?>





    <div class="statemark statecolor_<?php echo h($rat->state->next_ko_state_id) ?>"><?= h($next_ko_state->symbol) ?></div>
    <div class="staff-action-symbol">《</div>
    <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
    <div class="staff-action-symbol">》</div>
    <div class="statemark statecolor_<?php echo h($rat->state->next_ok_state_id) ?>"><?= h($next_ok_state->symbol) ?></div>

</div>
