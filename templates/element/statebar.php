
<div class="sheet-markers">
    <!-- if guest or non-staff user, show only current state -->
    <div class="statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
    <!-- else, if user is a staff member, show full state bar --> 
</div>
