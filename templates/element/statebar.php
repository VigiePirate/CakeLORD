<!-- ugly style to be replaced later by state->css_property -->

<?php if (! is_null($user) && $user->can('changeState', $sheet)) : ?>

    <div class="spacer"> </div>

    <div class="litter view content">
        <div class="staff-heading">
            <h2 class="staff"><?= __('Change state') ?></h2>
            <div class="sheet-markers">
                <?= $this->element('simple_statebar', ['sheet' => $sheet, 'user' => $user]) ?>
            </div>
        </div>
    </div>
<?php endif; ?>
