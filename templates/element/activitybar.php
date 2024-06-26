<?php if (! is_null($user) && $user->can('microEdit', $rattery)) : ?>

    <div class="spacer"> </div>

    <div class="user view content">
        <div class="staff-heading">
            <h2 class="staff"><?= __('Activity status') ?></h2>
            <div class="sheet-markers">
                <?php if ($rattery->is_alive) : ?>
                    <div class="current-statemark sun">
                        <?= h($rattery->is_alive_symbol) ?>
                    </div>
                    <div class="staff-action-symbol">&numsp;<?= $this->Html->image('arrow-right.svg') ?></div>
                    <div class="statemark">
                        <?= $this->Html->link(
                            h($rattery->next_alive_symbol),
                            ['action' => 'pause', $rattery->id],
                            ['class' => 'rotate'])
                        ?>
                    </div>
                <?php else : ?>
                    <?php if ($rattery->id == $rattery->user->main_rattery->id) : ?>
                        <div class="current-statemark">
                            <span class="rotate"><?= h($rattery->is_alive_symbol) ?></span>
                        </div>
                        <div class="staff-action-symbol">&numsp;<?= $this->Html->image('arrow-right.svg') ?></div>
                        <div class="statemark">
                            <?= $this->Html->link(
                                h($rattery->next_alive_symbol),
                                ['action' => 'reopen', $rattery->id],
                                ['class' => 'sun'])
                            ?>
                        </div>
                    <?php else : ?>
                        <div class="tooltip-state">
                            <div class="current-statemark">
                                <span class="rotate"><?= h($rattery->is_alive_symbol) ?></span>
                            </div>
                            <span class="tooltiptext-state hide-on-mobile"><?= __('This rattery is definitely closed') ?></span>
                        </div>
                    <?php endif ; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
