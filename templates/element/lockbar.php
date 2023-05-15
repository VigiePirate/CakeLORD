<?php if (! is_null($identity) && $identity->can('lock', $user)) : ?>

    <div class="spacer"> </div>

    <div class="user view content">
        <div class="staff-heading">
            <h2 class="staff"><?= __('Lock status') ?></h2>
            <div class="sheet-markers">
                <?php if ($user->is_locked) : ?>
                    <div class="current-statemark">
                        <?= $this->Html->image('/img/icon-lock.svg', [
                        'class' => 'lockbar-icon',
                        'alt' => __('Locked')]) ?>
                    </div>
                    <div class="staff-action-symbol">&numsp;<?= $this->Html->image('arrow-right.svg') ?></div>
                    <div class="statemark">
                        <?=
                            $this->Html->image('/img/icon-unlock.svg', [
                                'url' => ['controller' => 'Users', 'action' => 'unlock', $user->id],
                                'class' => 'lockbar-icon',
                                'alt' => __('Unlock')
                            ])
                        ?>
                    </div>
                <?php else : ?>
                    <div class="current-statemark">
                        <?= $this->Html->image('/img/icon-unlock.svg', [
                        'class' => 'lockbar-icon',
                        'alt' => __('Unlocked')]) ?>
                    </div>
                    <div class="staff-action-symbol">&numsp;<?= $this->Html->image('arrow-right.svg') ?></div>
                    <div class="statemark">
                        <?=
                            $this->Html->image('/img/icon-lock.svg', [
                                'url' => ['controller' => 'Users', 'action' => 'lock', $user->id],
                                'class' => 'lockbar-icon',
                                'alt' => __('Lock')
                            ])
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
