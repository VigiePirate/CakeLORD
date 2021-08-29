<!-- ugly style to be replaced later by state->css_property -->

<div class="sheet-markers">
    <!-- if guest or non-staff user, show only current state -->

    <!-- else, if user is a staff member, show full state bar -->

    <!-- if state is not frozen -->
    <?php if( !$rat->state->is_frozen ) : ?>
        <!-- if state needs staff action: show newt frozen, next ko, next ok -->
        <?php if( $rat->state->needs_staff_action ) : ?>
            <div class="statemark statecolor_<?php echo h($rat->state->next_frozen_state_id) ?>"><?= h($next_frozen_state->symbol) ?></div>
            <div class="statemark statecolor_<?php echo h($rat->state->next_ko_state_id) ?>"><?= h($next_ko_state->symbol) ?></div>
            <div class="staff-action-symbol">⮜</div>
            <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
            <div class="staff-action-symbol">⮞</div>
            <div class="statemark statecolor_<?php echo h($rat->state->next_ok_state_id) ?>"><?= h($next_ok_state->symbol) ?></div>
        <!-- if state doesn't need staff action: show next ko, next frozen -->
        <?php else : ?>
            <div class="statemark statecolor_<?php echo h($rat->state->next_ko_state_id) ?>"><?= h($next_ko_state->symbol) ?></div>
            <div class="staff-action-symbol">⮜</div>
            <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
            <div class="staff-action-symbol">⮞</div>
            <div class="statemark statecolor_<?php echo h($rat->state->next_frozen_state_id) ?>"><?= h($next_frozen_state->symbol) ?></div>
        <?php endif; ?>
    <!-- if state is frozen, show next thawed in the right order (depending on reliability) -->
    <?php else : ?>
        <?php if( $rat->state->is_reliable ) : ?>
            <div class="statemark statecolor_<?php echo h($rat->state->next_thawed_id) ?>"><?= h($next_thawed_state->symbol) ?></div>
            <div class="staff-action-symbol">⮜</div>
            <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
        <?php else : ?>
            <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
            <div class="staff-action-symbol">⮞</div>
            <div class="statemark statecolor_<?php echo h($rat->state->next_thawed_state_id) ?>"><?= h($next_thawed_state->symbol) ?></div>
    <?php endif; ?>
</div>
