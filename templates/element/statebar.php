<!-- ugly style to be replaced later by state->css_property -->

<?php if ($user->can('changeState', $sheet)) : ?>

    <div class="spacer"> </div>

    <div class="litter view content">
        <div class="staff-heading">
            <h2 class="staff"><?= __('Change state') ?></h2>

            <div class="sheet-markers">
                <!-- if state is not frozen -->
                <?php if( !$sheet->state->is_frozen ) : ?>
                    <!-- if state needs staff action: show newt frozen, next ko, next ok -->
                    <?php if( $sheet->state->needs_staff_action ) : ?>
                        <?php if( !empty($sheet->state->next_frozen_state_id) ) : ?>
                            <div class="statemark">
                                <?= $this->Html->link(
                                    $next_frozen_state->symbol,
                                    ['action' => 'freeze', $sheet->id],
                                    ['class' => 'statecolor_' . $sheet->state->next_frozen_state_id])
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="statemark">
                            <?= $this->Html->link(
                                $next_ko_state->symbol,
                                ['action' => 'blame', $sheet->id],
                                ['class' => 'statecolor_' . $sheet->state->next_ko_state_id])
                            ?>
                        </div>
                        <div class="staff-action-symbol">⮜&numsp;</div>
                        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>">
                            <?= h($sheet->state->symbol) ?>
                        </div>
                        <div class="staff-action-symbol">&numsp;⮞</div>
                        <div class="statemark">
                            <?= $this->Html->link(
                                $next_ok_state->symbol,
                                ['action' => 'approve', $sheet->id],
                                ['class' => 'statecolor_' . $sheet->state->next_ok_state_id])
                            ?>
                        </div>

                    <!-- if state needs user action: nothing to do-->
                    <?php elseif( $sheet->state->needs_user_action ) : ?>
                        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>"><?= h($sheet->state->symbol) ?></div>
                    <?php else : ?>
                        <!-- if state doesn't need any action: show next ko, next frozen -->
                        <div class="statemark">
                            <?= $this->Html->link(
                                $next_ko_state->symbol,
                                ['action' => 'blame', $sheet->id],
                                ['class' => 'statecolor_' . $sheet->state->next_ko_state_id])
                            ?>
                        </div>
                        <div class="staff-action-symbol">⮜&numsp;</div>
                        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>">
                            <?= h($sheet->state->symbol) ?>
                        </div>
                        <div class="staff-action-symbol">&numsp;⮞</div>
                        <div class="statemark">
                            <?= $this->Html->link(
                                $next_frozen_state->symbol,
                                ['action' => 'freeze', $sheet->id],
                                ['class' => 'statecolor_' . $sheet->state->next_frozen_state_id])
                            ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <!-- if state is frozen, show next thawed in the right order (depending on reliability) -->
                    <?php if( $sheet->state->is_reliable ) : ?>
                        <div class="statemark">
                            <?= $this->Html->link(
                                $next_thawed_state->symbol,
                                ['action' => 'thaw', $sheet->id],
                                ['class' => 'statecolor_' . $sheet->state->next_thawed_state_id])
                            ?>
                        </div>
                        <div class="staff-action-symbol">⮜&numsp;</div>
                        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>">
                            <?= h($sheet->state->symbol) ?>
                        </div>
                    <?php else : ?>
                        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>">
                            <?= h($sheet->state->symbol) ?>
                        </div>
                        <div class="staff-action-symbol">&numsp;⮞</div>
                        <div class="statemark">
                            <?= $this->Html->link(
                                $next_thawed_state->symbol,
                                ['action' => 'thaw', $sheet->id],
                                ['class' => 'statecolor_' . $sheet->state->next_thawed_state_id])
                            ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
