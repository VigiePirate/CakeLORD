<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Rattery $rattery
*/
?>
<div class="row">
    <div class="column-responsive column-50">
        <div class="ratteries view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Snapshot') ?></div>
                <div class="sheet-markers">
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($rattery->state->name) ?></span>
                    </div>
                </div>
            </div>

            <h1 class="half"><?= h($snap_rattery->full_name) . '<span class="rotate"> ' . h($snap_rattery->is_inactive_symbol) . '</span>'?></h1> <!-- -->

            <div class="column column-photo half-column-photo">
            <?php if ($rattery->picture != '' && $rattery->picture != 'Unknown.png') : ?>
                <?= $this->Html->image(UPLOADS . $rattery->picture, ['alt' => $rattery->prefix]) ?>
            <?php else : ?>
                <?= $this->Html->image('UnknownRattery.svg') ?>
            <?php endif; ?>
            </div>

            <table class="aside-photo">
                <tr>
                    <th><?= __('Prefix') ?></th>
                    <?php if (in_array('prefix', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $snap_rattery->has('prefix') ? h($snap_rattery->prefix) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <?php if (in_array('name', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $snap_rattery->has('name') ? h($snap_rattery->name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Owner') ?></th>
                    <?php if (in_array('user_id', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $snap_rattery->has('user') ? $this->Html->link($snap_rattery->user->username, ['controller' => 'Users', 'action' => 'view', $snap_rattery->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Founded in') ?></th>
                    <?php if (in_array('birth_year', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($snap_rattery->birth_year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Country') ?></th>
                    <?php if (in_array('country_id', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $snap_rattery->has('country') ? h($snap_rattery->country->name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Localization') ?></th>
                    <?php if (in_array('district', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($snap_rattery->district) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zip Code') ?></th>
                    <?php if (in_array('zip_code', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($snap_rattery->zip_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Website') ?></th>
                    <?php if (in_array('website', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $snap_rattery->website ? $this->Html->link(h($snap_rattery->website)) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('On?') ?></th>
                    <?php if (in_array('is_alive', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $snap_rattery->is_alive ? __('Yes') : __('No') ?></td>
                </tr>
                <tr>
                    <th><?= __('Wants statistics') ?></th>
                    <?php if (in_array('prefix', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $snap_rattery->wants_statistic ? __('Yes') : __('No') ?></td>
                </tr>
            </table>

            <?php if (in_array('comments', $diff_list)) : ?>
                <div class="text minus">
            <?php else : ?>
                <div class="text">
            <?php endif ; ?>
                <blockquote>
                    <div class="markdown">
                        <?= $this->Commonmark->sanitize($snap_rattery->comments); ?>
                    </div>
                </blockquote>
            </div>

        </div>
    </div>

    <div class="column-responsive column-50">
        <div class="ratteries view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= $rattery->is_generic ? __('Generic origin') :  __('Rattery') ?></div>
                <div class="sheet-markers">
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($rattery->state->name) ?></span>
                    </div>
                </div>
            </div>

            <h1 class="half"><?= h($rattery->full_name) . '<span class="rotate"> ' . h($rattery->is_inactive_symbol) . '</span>'?></h1> <!-- -->

            <div class="column column-photo half-column-photo">
            <?php if ($rattery->picture != '' && $rattery->picture != 'Unknown.png') : ?>
                <?= $this->Html->image(UPLOADS . $rattery->picture, ['alt' => $rattery->prefix]) ?>
            <?php else : ?>
                <?= $this->Html->image('UnknownRattery.svg') ?>
            <?php endif; ?>
            </div>

            <table class="aside-photo">
                <tr>
                    <tr>
                        <th><?= __('Prefix') ?></th>
                        <?php if (in_array('prefix', $diff_list)) : ?>
                            <td class="plus">
                        <?php else : ?>
                            <td>
                        <?php endif ; ?>
                        <?= $rattery->has('prefix') ? h($rattery->prefix) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Name') ?></th>
                        <?php if (in_array('name', $diff_list)) : ?>
                            <td class="plus">
                        <?php else : ?>
                            <td>
                        <?php endif ; ?>
                        <?= $rattery->has('name') ? h($rattery->name) : '' ?></td>
                    </tr>
                    <th><?= __('Owner') ?></th>
                    <?php if (in_array('user_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rattery->has('user') ? $this->Html->link($rattery->user->username, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Founded in') ?></th>
                    <?php if (in_array('country_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rattery->birth_year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Country') ?></th>
                    <?php if (in_array('country_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rattery->has('country') ? h($rattery->country->name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Localization') ?></th>
                    <?php if (in_array('district', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rattery->district) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zip Code') ?></th>
                    <?php if (in_array('zip_code', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rattery->zip_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Website') ?></th>
                    <?php if (in_array('website', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rattery->website ? $this->Html->link(h($rattery->website)) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('On?') ?></th>
                    <?php if (in_array('is_alive', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rattery->is_alive ? __('Yes') : __('No') ?></td>
                </tr>
                <tr>
                    <th><?= __('Wants statistics') ?></th>
                    <?php if (in_array('wants_statistic', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rattery->wants_statistic ? __('Yes') : __('No') ?></td>
                </tr>
            </table>

            <?php if (in_array('comments', $diff_list)) : ?>
                <div class="text plus">
            <?php else : ?>
                <div class="text">
            <?php endif ; ?>
                <blockquote>
                    <div class="markdown">
                        <?= $this->Commonmark->sanitize($rattery->comments); ?>
                    </div>
                </blockquote>
            </div>

        </div>
    </div>
</div>

<div class="spacer"></div>

<div class="row">

    <div class="column-responsive column-50">
        <div class="tooltip-staff">
            <?= $this->Html->image('/img/icon-restore.svg', [
                'url' => ['controller' => 'ratteries', 'action' => 'restore', $rattery->id, $snapshot->id],
                'class' => 'side-nav-icon restore-icon',
                'alt' => __('Edit in database')]) ?>
            <span class="tooltiptext-staff"><?= __('Edit in database') ?></span>
        </div>
    </div>

    <div class="column-responsive column-50">
        <div class="sheet-markers float-right mini-statebar">
            <?= $this->element('simple_statebar', ['controller' => 'Ratteries', 'sheet' => $rattery, 'user' => $user]) ?>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
