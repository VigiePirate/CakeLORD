<!-- ugly style to be replaced later by state->css_property -->

<?php if (! is_null($user) && $user->can('changeState', $sheet)) : ?>

    <div class="spacer"> </div>

    <div class="litter view content">
        <?php echo $this->Form->create($sheet, ['type' => 'post', 'url' => ['action' => 'moderate', $sheet->id]]); ?>
        <!-- form "submit" buttons are created in simple statebar -->
            <div class="staff-heading">
                <h2 class="staff"><?= __('Change state') ?></h2>
                <div class="sheet-markers">
                    <?= $this->element('simple_statebar', ['sheet' => $sheet, 'user' => $user]) ?>
                </div>
            </div>
            <div>
                <?= $this->element('side_message_control', ['sheet' => $sheet]) ?>
            </div>
        <?= $this->Form->end(); ?>
    </div>
<?php endif; ?>
