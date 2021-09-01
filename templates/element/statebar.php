<!-- ugly style to be replaced later by state->css_property -->
<!-- very ugly code, tends to prove that it's not the right way to do it! -->

<div class="sheet-markers">
    <!-- if user is a staff member, show full state bar (now only checking connection) -->
    <?php if ( $this->getRequest()->getSession()->check('Auth.id') ) : ?>
        <!-- if state is not frozen -->
        <?php if( !$sheet->state->is_frozen ) : ?>
            <!-- if state needs staff action: show newt frozen, next ko, next ok -->
            <?php if( $sheet->state->needs_staff_action ) : ?>
                <?php if( !empty($sheet->state->next_frozen_state_id) ) : ?>
                    <div class="statemark statecolor_<?php echo h($sheet->state->next_frozen_state_id) ?>"><?= h($next_frozen_state->symbol) ?></div>
                <?php endif; ?>
                <div class="statemark statecolor_<?php echo h($sheet->state->next_ko_state_id) ?>"><?= h($next_ko_state->symbol) ?></div>
                <div class="staff-action-symbol">⮜</div>
                <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>"><?= h($sheet->state->symbol) ?></div>
                <div class="staff-action-symbol">⮞</div>
                <div class="statemark statecolor_<?php echo h($sheet->state->next_ok_state_id) ?>"><?= h($next_ok_state->symbol) ?></div>
            <!-- if state needs user action: nothing to do-->
            <?php elseif( $sheet->state->needs_user_action ) : ?>
                <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>"><?= h($sheet->state->symbol) ?></div>
            <?php else : ?>
                <!-- if state doesn't any action: show next ko, next frozen -->
                <div class="statemark statecolor_<?php echo h($sheet->state->next_ko_state_id) ?>"><?= h($next_ko_state->symbol) ?></div>
                <div class="staff-action-symbol">⮜</div>
                <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>"><?= h($sheet->state->symbol) ?></div>
                <div class="staff-action-symbol">⮞</div>
                <div class="statemark statecolor_<?php echo h($sheet->state->next_frozen_state_id) ?>"><?= h($next_frozen_state->symbol) ?></div>
            <?php endif; ?>
        <?php else : ?>
            <!-- if state is frozen, show next thawed in the right order (depending on reliability) -->
            <?php if( $sheet->state->is_reliable ) : ?>
                <div class="statemark statecolor_<?php echo h($sheet->state->next_thawed__state_id) ?>"><?= h($next_thawed_state->symbol) ?></div>
                <div class="staff-action-symbol">⮜</div>
                <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>"><?= h($sheet->state->symbol) ?></div>
            <?php else : ?>
                <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>"><?= h($sheet->state->symbol) ?></div>
                <div class="staff-action-symbol">⮞</div>
                <div class="statemark statecolor_<?php echo h($sheet->state->next_thawed_state_id) ?>"><?= h($next_thawed_state->symbol) ?></div>
            <?php endif; ?>
        <?php endif; ?>
    <?php else : ?>
    <!-- else, if guest or non-staff user, show only current state -->
    <div class="tooltip-state">
        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>"><?= h($sheet->state->symbol) ?></div>
        <span class="tooltiptext-state hide-on-mobile"><?= h($sheet->state->name) ?></span>
    </div>
    <?php endif; ?>
</div>
