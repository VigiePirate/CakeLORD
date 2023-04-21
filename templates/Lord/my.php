<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/staffbar') ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="users content view">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->dashboard_title) ?></div>
            </div>
            <h1><?= __('My back office') ?> </h1>
        </div>
        <div class="spacer"> </div>

        <div class="view content">

            <h2><?= __('Sheets needing staff action') ?></h2>

            <h3><?= __('Rats') ?></h3>
            <div class="button-small">
                <?= $this->Html->link(__('See all pending rats'), ['controller' => 'Rats', 'action' => 'needs_staff'], ['class' => 'button button-staff float-right']) ?>
            </div>
            <p><?= __('<strong>{0} rat sheets</strong> are currently waiting for staff action. Most recent are:', [$count['rats']]) ?></p>
            <?= $this->element('simple_staff_rats') ?>

            <h3><?= __('Litters') ?></h3>
            <div class="button-small">
                <?= $this->Html->link(__('See all pending litters'), ['controller' => 'Litters', 'action' => 'needs_staff'], ['class' => 'button button-staff float-right']) ?>
            </div>
            <p><?= __('<strong>{0} litter sheets</strong> are currently waiting for staff action. Most recent are:', [$count['litters']]) ?></p>
            <?= $this->element('simple_staff_litters') ?>

            <h3><?= __('Ratteries') ?></h3>
            <div class="button-small">
                <?= $this->Html->link(__('See all pending ratteries'), ['controller' => 'Ratteries', 'action' => 'needs_staff'], ['class' => 'button button-staff float-right']) ?>
            </div>
            <p><?= __('<strong>{0} rattery sheets</strong> are currently waiting for staff action. Most recent are:', [$count['ratteries']]) ?><p>
            <?= $this->element('simple_staff_ratteries') ?>

        </div>
        <div class="spacer"> </div>

        <?php if ($user->role->is_staff) : ?>
            <div class="view content">
                <div class="button-small">
                    <?= $this->Html->link(__('See all issues'), ['controller' => 'Issues', 'action' => 'index'], ['class' => 'button button-staff float-right']) ?>
                </div>
                <h2><?= __('Open issues') ?></h2>
            </div>
            <div class="spacer"> </div>
        <?php endif; ?>

        <?php if ($user->role->can_describe || $user->role->can_describe) : ?>
            <div class="spacer"> </div>
            <div class="view content">
                <h2><?= __('Documentation') ?></h2>
                <?php if ($user->role->can_document) : ?>
                    <h3><?= __('Guides') ?></h3>
                    <table class="condensed">
                        <tr>
                            <th><?= $this->Html->link(__('Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></th>
                            <td><?= __('Manage categories') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></th>
                            <td><?= __('Manage articles') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('FAQs'), ['controller' => 'FAQs', 'action' => 'index']) ?></th>
                            <td><?= __('Manage FAQs') ?></td>
                        </tr>
                    </table>
                <?php endif; ?>
                <?php if ($user->role->can_describe) : ?>
                    <h3><?= __('Varieties') ?></h3>
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
                    <h3><?= __('Death Causes') ?></h3>
                    <table class="condensed">
                        <tr>
                            <th><?= $this->Html->link(__('Death Categories'), ['controller' => 'PrimaryDeathCauses', 'action' => 'index']) ?></th>
                            <td><?= __('Manage death categories') ?></td>
                        </tr>
                        <tr>
                            <th><?= $this->Html->link(__('Death Causes'), ['controller' => 'PrimaryDeathCauses', 'action' => 'index']) ?></th>
                            <td><?= __('Manage death causes') ?></td>
                        </tr>
                    </table>
                <?php endif; ?>
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
