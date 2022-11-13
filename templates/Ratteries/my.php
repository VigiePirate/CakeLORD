<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">

            <?= $this->Html->link(__('New Rattery'), ['action' => 'register'], ['class' => 'button float-right']) ?>
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->username) . '’s dashboard' ?></div>
            </div>
            <h1><?= __('My ratteries') ?> </h1>
            <?= $this->Flash->render(); ?>

            <?php if (is_null($rattery)) : ?>
                <?php if ($ratteries->isEmpty()) : ?>
                    <div class="message default"><?= __('You dont have any active rattery at the moment. You can register one by hitting the “New Rattery” button above.') ?></div>
                <?php else : ?>
                    <div class="message default"><?= __('You dont have any active rattery at the moment. You can activate one from the list below, or by adding a new litter.') ?></div>
                <?php endif ; ?>
            <?php else : ?>

            <div class="button-small">
                <?= $this->Html->link(__('See rattery sheet'), ['controller' => 'Ratteries', 'action' => 'view', $rattery->id], ['class' => 'button float-right']) ?>
            </div>

            <h2><?= h($rattery->full_name) ?></h2>

            <div class="row row-reverse row-with-photo">
                <div class="column-responsive column-80">
                    <table class="aside-photo">
                        <tr>
                            <th><?= __('Founded in') ?></th>
                            <td><?= ($rattery->birth_year != '0000') ? h($rattery->birth_year) : h(substr($stats['activityYears'],0,4)) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Country') ?></th>
                            <td><?= $rattery->has('country') ? h($rattery->country->name) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Localization') ?></th>
                            <td><?= h($rattery->district) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Zip Code') ?></th>
                            <td><?= h($rattery->zip_code) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Website') ?></th>
                            <td><?= $rattery->website ? $this->Html->link(h($rattery->website)) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Do you currently show your statistics?') ?></th>
                            <td><?= $rattery->wants_statistic
                                    ? __('Yes') . ' — '. $this->Html->link(__('I want to hide them'), ['action' => 'switchStats', $rattery->id])
                                    : __('No') . ' — ' . $this->Html->link(__('I want to show them'), ['action' => 'switchStats', $rattery->id])
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="column footer-center column-photo">
                    <?php if ($rattery->picture != '') : ?>
                        <?= $this->Html->image(UPLOADS . $rattery->picture, ['alt' => $rattery->prefix]) ?>
                    <?php else : ?>
                        <?= $this->Html->image('UnknownRattery.svg', ['url' => ['action' => 'changePicture', $rattery->id]]) ?>
                    <?php endif ?>
                </div>
            </div>

            <?php endif; ?>

            <?php if (! $ratteries->isEmpty()) : ?>
                <h2><?= __('All my ratteries') ?> </h2>
                <?= $this->element('simple_ratteries', [
                    'rubric' => '',
                    'ratteries' => $ratteries,
                    'exceptions' => [
                        'picture',
                        'owner_user',
                        'country',
                        'actions'
                    ],
                ]) ?>
            <?php endif; ?>
        <!-- </div> -->
    </div>
</div>
