<!-- ugly style to be replaced later by state->css_property -->

<div class="sheet-markers">
    <!-- if guest or non-staff user, show only current state -->

    <!-- else, if user is a staff member, show full state bar -->
    <div class="statemark statecolor_<?php echo h($rat->state->next_ko_state_id) ?>"><?= h($next_ko_state->symbol) ?></div>
    <div> << </div>
    <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
    <div> >> </div>
    <div class="statemark statecolor_<?php echo h($rat->state->next_ok_state_id) ?>"><?= h($next_ok_state->symbol) ?></div>

</div>
