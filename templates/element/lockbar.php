<!-- if user is a staff member, show full state bar (now only checking connection) -->
<?php if ( $this->getRequest()->getSession()->check('Auth.id') ) : ?>

    <div class="spacer"> </div>

    <div class="litter view content">
        <div class="staff-heading">
            <h2 class="staff"><?= __('Change state') ?></h2>
            <div class="sheet-markers">

            </div>
        </div>
    </div>
<?php endif; ?>
