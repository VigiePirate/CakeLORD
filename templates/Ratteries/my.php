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
                <div class="sheet-title pretitle"><?= __('{0}’s dashboard', [h($user->username)]) ?></div>
            </div>
            <h1><?= __('My ratteries') ?> </h1>
            <?= $this->Flash->render(); ?>

            <?php if (! is_null($alive_ratteries) && $alive_ratteries->isEmpty()) : ?>
                <?php if (! is_null($closed_ratteries) && $closed_ratteries->isEmpty()) : ?>
                    <div class="message default"><?= __('You dont have any active rattery at the moment. You can activate one from the list below, or by adding a new litter.') ?></div>
                <?php else : ?>
                    <div class="message default"><?= __('You dont have any active rattery at the moment. You can register one by hitting the “New Rattery” button above.') ?></div>
                <?php endif ; ?>
            <?php else : ?>

                <?php foreach($alive_ratteries as $rattery) : ?>

                </div>
                <div class="spacer"></div>
                <div class="users view content">

                    <div class="button-small">
                        <?= $this->Html->link(__('See rattery sheet'), ['controller' => 'Ratteries', 'action' => 'view', $rattery->id], ['class' => 'button float-right']) ?>
                    </div>

                    <h2><?= h($rattery->full_name) ?></h2>

                    <div class="row row-reverse row-with-photo">
                        <div class="column-responsive column-80">

                            <table class="aside-photo">
                                <tr>
                                    <th><?= __('Founded in') ?></th>
                                    <td><?= ($rattery->birth_year != '0000') ? h($rattery->birth_year) : h(substr($stats['activityYears'],0,4)) ?> — <?= $this->Html->link(__('Pause my rattery now'), ['action' => 'pause', $rattery->id]) ?></td>
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
                                    <td><?= $rattery->has('zip_code') ?
                                        h($rattery->zip_code) . ' — ' . $this->Html->link(__('Relocate or remove'), ['action' => 'relocate', $rattery->id]) :
                                        $this->Html->link(__('Declare a location to appear on the rattery map'), ['action' => 'relocate', $rattery->id])
                                        ?>
                                    </td>
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
                        <div class="column column-photo edit-photo">
                            <?php if ($rattery->picture != '' && $rattery->picture != 'Unknown.png') : ?>
                                <?= $this->Html->image(UPLOADS . $rattery->picture, ['alt' => $rattery->prefix, 'url' => ['action' => 'changePicture', $rattery->id]]) ?>
                            <?php else : ?>
                                <?= $this->Html->image('UnknownRattery.svg', ['url' => ['action' => 'changePicture', $rattery->id]]) ?>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ; ?>
            <?php endif; ?>

            <?php if (! $closed_ratteries->isEmpty()) : ?>
            </div>
            <div class="spacer"></div>
            <div class="users view content">
                <h2><?= __('My old ratteries') ?>
                <?php foreach($closed_ratteries as $rattery) : ?>

                    <div class="button-small">
                        <?= $this->Html->link(__('See rattery sheet'), ['controller' => 'Ratteries', 'action' => 'view', $rattery->id], ['class' => 'button float-right']) ?>
                    </div>

                    <h3><?= h($rattery->full_name) . '<span class="rotate"> ' . h($rattery->is_inactive_symbol) . '</span>' ?></h3>

                    <div class="row row-reverse row-with-photo">
                        <div class="column-responsive column-80">

                            <table class="aside-photo">
                                <tr>
                                    <th><?= __('Founded in') ?></th>
                                    <td><?= ($rattery->birth_year != '0000') ? h($rattery->birth_year) : h(substr($stats['activityYears'],0,4)) ?> — <?= $this->Html->link(__('Reopen this rattery now'), ['action' => 'reopen', $rattery->id]) ?></td>
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
                    </div>
                <?php endforeach ; ?>
            <?php endif; ?>
        <!-- </div> -->
    </div>
</div>
