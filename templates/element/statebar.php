<!-- ugly style to be replaced later by state->css_property -->

<?php if (! is_null($user) && $user->can('changeState', $sheet)) : ?>

    <div class="spacer"> </div>

    <div class="view content">
        <?php echo $this->Form->create($sheet, ['type' => 'post', 'url' => ['action' => 'moderate', $sheet->id]]); ?>
        <!-- form "submit" buttons are created in simple statebar -->
            <div class="staff-heading">
                <h2 class="staff"><?= __('Change state') ?></h2>
                <div class="sheet-markers">
                    <?=
                        $this->element('simple_statebar', [
                            'sheet' => $sheet,
                            'user' => $user
                        ]);
                    ?>
                </div>
            </div>

            <!-- show side message form, except if you can't do anything -->
            <?php if (! $sheet->state->needs_user_action) : ?>
                <div>
                    <?=
                        $this->element('side_message_control', [
                            'user' => $user,
                            'sheet' => $sheet,
                            'required' => false,
                        ]);
                    ?>
                </div>
            <?php endif ;?>

        <?= $this->Form->end(); ?>
    </div>
<?php endif; ?>
