<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="users content view">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->username) . '’s dashboard' ?></div>
            </div>
            <h1><?= __('My back office') ?> </h1>
        </div>
        <div class="spacer"> </div>

        <div class="view content">
            <?= $this->Html->link(__('See all'), ['controller' => 'Rats', 'action' => 'needs_staff'], ['class' => 'button button-staff float-right']) ?>
            <h2><?= __('Sheets needing staff action') ?></h2>
        </div>
        <div class="spacer"> </div>

        <div class="view content">
            <?= $this->Html->link(__('See all'), ['controller' => 'Rats', 'action' => 'needs_user'], ['class' => 'button button-staff float-right']) ?>
            <h2><?= __('Sheets needing user action') ?></h2>
        </div>

        <?php if ($user->role->is_admin) : ?>
            <div class="spacer"> </div>
            <div class="view content">
                <h2><?= __('Administration') ?></h2>
            </div>
        <?php endif; ?>

        <?php if ($user->role->is_root) : ?>
            <div class="spacer"> </div>
            <div class="view content">
                <h2><?= __('Configuration') ?></h2>
            </div>
        <?php endif; ?>
    <div>
</div>

<?= $this->Html->css('tabs.css') ?>
