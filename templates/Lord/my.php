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
            <?= $this->Html->link(__('See all'), ['controller' => 'Issues', 'action' => 'index'], ['class' => 'button button-staff float-right']) ?>
            <h2><?= __('Open issues') ?></h2>
        </div>
        <div class="spacer"> </div>

        <?php if ($user->role->can_configure) : ?>
            <div class="spacer"> </div>
            <div class="view content">
                <h2><?= __('Administration') ?></h2>
                <table class="condensed">
                    <tr>
                        <th><?= $this->Html->link(__('Coats'), ['controller' => 'Coats', 'action' => 'index']) ?></th>
                        <td><?= __('Manage coats') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('Colors'), ['controller' => 'Colors', 'action' => 'index']) ?></th>
                        <td><?= __('Manage colors') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('Dilutions'), ['controller' => 'Dilutions', 'action' => 'index']) ?></th>
                        <td><?= __('Manage eyecolors') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('Earsets'), ['controller' => 'Earsets', 'action' => 'index']) ?></th>
                        <td><?= __('Manage ear types') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('Eyecolors'), ['controller' => 'Eyecolors', 'action' => 'index']) ?></th>
                        <td><?= __('Manage eyecolors') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('Markings'), ['controller' => 'Markings', 'action' => 'index']) ?></th>
                        <td><?= __('Manage markings') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('Singularities'), ['controller' => 'Singularities', 'action' => 'index']) ?></th>
                        <td><?= __('Manage singularities') ?></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>

        <?php if ($user->role->can_configure) : ?>
            <div class="spacer"> </div>
            <div class="view content">
                <h2><?= __('Configuration') ?></h2>
                <table class="condensed">
                    <tr>
                        <th><?= $this->Html->link(__('Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></th>
                        <td><?= __('Configure roles and permissions') ?></td>
                    </tr>
                    <tr>
                        <th><?= $this->Html->link(__('States'), ['controller' => 'States', 'action' => 'index']) ?></th>
                        <td><?= __('Configure states and sheet workflow') ?></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
    <div>
</div>

<?= $this->Html->css('tabs.css') ?>
