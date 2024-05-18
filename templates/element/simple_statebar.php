<?php
    if (! isset($controller)) {
        $controller = $this->getRequest()->getParam('controller');
    }
?>

<?php if (! $sheet->state->is_frozen ) : ?>
    <!-- if state needs staff action: show next frozen, next ko, next ok -->
    <?php if ($sheet->state->needs_staff_action) : ?>
        <?php if (! empty($sheet->state->next_frozen_state_id) ) : ?>
            <div class="statemark">
                <?=
                    $this->Form->button(
                        $next_frozen_state->symbol,
                        ['name' => 'decision', 'value' =>  'freeze', 'class' => 'statecolor_' . $sheet->state->next_frozen_state_id]
                    )
                ?>
            </div>
        <?php endif; ?>
        <div class="statemark">
            <?=
                $this->Form->button(
                    $next_ko_state->symbol,
                    ['name' => 'decision', 'value' => 'blame', 'class' => 'statecolor_' . $sheet->state->next_ko_state_id]
                );
            ?>
        </div>
        <div class="staff-action-symbol"><?= $this->Html->image('arrow-left.svg') ?>&numsp;</div>
        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>">
            <?= h($sheet->state->symbol) ?>
        </div>
        <div class="staff-action-symbol">&numsp;<?= $this->Html->image('arrow-right.svg') ?></div>
        <div class="statemark">
            <?=
                $this->Form->button(
                    $next_ok_state->symbol,
                    ['name' => 'decision', 'value' => 'approve', 'class' => 'statecolor_' . $sheet->state->next_ok_state_id]
                );
            ?>
        </div>

    <!-- if state needs user action: nothing to do-->
    <?php elseif( $sheet->state->needs_user_action ) : ?>
        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>"><?= h($sheet->state->symbol) ?></div>
    <?php else : ?>
        <!-- if state doesn't need any action: show next ko, next frozen -->
        <div class="statemark">
            <?=
                $this->Form->button(
                    $next_ko_state->symbol,
                    ['name' => 'decision', 'value' => 'blame', 'class' => 'statecolor_' . $sheet->state->next_ko_state_id]
                );
            ?>
        </div>
        <div class="staff-action-symbol"><?= $this->Html->image('arrow-left.svg') ?>&numsp;</div>
        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>">
            <?= h($sheet->state->symbol) ?>
        </div>
        <div class="staff-action-symbol">&numsp;<?= $this->Html->image('arrow-right.svg') ?></div>
        <div class="statemark">
            <?=
                $this->Form->button(
                    $next_frozen_state->symbol,
                    ['name' => 'decision', 'value' => 'freeze', 'class' => 'statecolor_' . $sheet->state->next_frozen_state_id]
                );
            ?>
        </div>
    <?php endif; ?>
<?php else : ?>
    <!-- if state is frozen, show next thawed in the right order (depending on reliability) -->
    <?php if ($sheet->state->is_reliable) : ?>
        <div class="statemark">
            <?=
                $this->Form->button(
                    $next_thawed_state->symbol,
                    ['name' => 'decision', 'value' => 'thaw', 'class' => 'statecolor_' . $sheet->state->next_thawed_state_id]
                );
            ?>
        </div>
        <div class="staff-action-symbol"><?= $this->Html->image('arrow-left.svg') ?>&numsp;</div>
        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>">
            <?= h($sheet->state->symbol) ?>
        </div>
    <?php else : ?>
        <?php if (! empty($sheet->state->next_frozen_state_id) ) : ?>
            <div class="statemark">
                <?= 
                    $this->Form->button(
                        $next_frozen_state->symbol,
                        ['name' => 'decision', 'value' =>  'freeze', 'class' => 'statecolor_' . $sheet->state->next_frozen_state_id]
                    )
                ?>
            </div>
            <div class="staff-action-symbol"><?= $this->Html->image('arrow-left.svg') ?>&numsp;</div>
        <?php endif; ?>

        <div class="current-statemark statecolor_<?php echo h($sheet->state_id) ?>">
            <?= h($sheet->state->symbol) ?>
        </div>
        <div class="staff-action-symbol">&numsp;<?= $this->Html->image('arrow-right.svg') ?></div>
        <div class="statemark">
            <?=
                $this->Form->button(
                    $next_thawed_state->symbol,
                    ['name' => 'decision', 'value' => 'thaw', 'class' => 'statecolor_' . $sheet->state->next_thawed_state_id]
                );
            ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
