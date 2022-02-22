<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <div class="spacer"> </div>
            <?= $this->Html->image('/img/icon-search-rats.svg', [
                  'url' => ['controller' => 'Rats', 'action' => 'ownedBy', $user->username],
                  'class' => 'side-nav-icon',
                  'alt' => __('Find their rats')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Owner') ?></div> <!-- h($user->role->name) -->
            </div>
            <h1><?= h($user->username) ?></h1>

            <div class="row">
                <?php if ($user->avatar != '') : ?>
                    <div class="column-responsive column-80">
                    <h2>Information</h2>
                    <table class="condensed stats">
                <?php else : ?>
                    <div class="column-responsive column-100">
                    <h2>Information</h2>
                    <table class="condensed">
                <?php endif ?>
                        <tr>
                            <th><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Localization') ?></th>
                            <td><?= h($user->localization) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Role') ?></th>
                            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                        </tr>
                    </table>
                </div>
                <?php if ($user->avatar != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $user->avatar, ['alt' => $user->avatar]) ?>
                    </div>
                <?php endif ?>
            </div>
            <h2><?= __('About me') ?></h2>
            <div class="text">
                <blockquote>
                    <div class="markdown">
                        <?= $this->Commonmark->sanitize($user->about_me); ?>
                    </div>
                </blockquote>
            </div>

            <div class="spacer"> </div>
            <h2><?= __('Related entries') ?></h2>

            <?php if (!empty($user->ratteries)) : ?>
                <div class="related">
                    <details open>
                        <summary><?= __('Ratteries') ?></summary>
                        <?= $this->element('simple_ratteries', [ //rats
                            'rubric' => __(''),
                            'ratteries' =>  $user->ratteries,
                            'exceptions' => [
                                'picture',
                                'owner_user',
                                'actions'
                            ],
                        ]) ?>
                    </details>
                </div>
            <?php endif; ?>

            <div class="related">
                <details open>
                    <summary><?= __('Owned Rats') ?></summary>
                    <?= $this->element('simple_rats', [
                        'rubric' => __(''),
                        'rats' =>  $user->owner_rats,
                        'exceptions' => [
                            'picture',
                            'pup_name',
                            'owner_user_id',
                            'death_primary_cause',
                            'death_secondary_cause',
                            'actions'
                        ],
                    ]) ?>
                </details>
            </div>

            <div class="related">
                <details>
                    <summary><?= __('Managed Rats') ?></summary>
                    <?= $this->element('simple_rats', [ //rats
                        'rubric' => __(''),
                        'rats' =>  $user->creator_rats,//$offsprings,
                        'exceptions' => [
                            'picture',
                            'pup_name',
                            'owner_user_id',
                            'death_primary_cause',
                            'death_secondary_cause',
                            'actions'
                        ],
                    ]) ?>
                </details>
            </div>

            <div class="spacer"> </div>
            <h2 class="staff"><?= __('Private information') ?></h2>
            <div class="related">
                <h3 class='staff'><?= __('Staff Comments') ?></h3>
                <div class="text">
                    <blockquote>
                        <?= $this->Text->autoParagraph(h($user->staff_comments)); ?>
                    </blockquote>
                </div>
            </div>

            <div class="related">
                <h3 class='staff'><?= __('User information') ?></h3>
                <table class="condensed">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>

                    <tr>
                        <th><?= __('Email') ?></th>
                        <td><?= h($user->email) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Password') ?></th>
                        <td><?= h($user->password) ?></td>
                    </tr>

                    <tr>
                        <th><?= __('Firstname') ?></th>
                        <td><?= h($user->firstname) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Lastname') ?></th>
                        <td><?= h($user->lastname) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Birth Date') ?></th>
                        <td><?= h($user->birth_date) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Sex') ?></th>
                        <td><?= h($user->sex) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Failed Login Attempts') ?></th>
                        <td><?= $this->Number->format($user->failed_login_attempts) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Failed Login Last Date') ?></th>
                        <td><?= h($user->failed_login_last_date) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Wants Newsletter') ?></th>
                        <td><?= $user->wants_newsletter ? __('Yes') : __('No'); ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Is Locked') ?></th>
                        <td><?= $user->is_locked ? __('Yes') : __('No'); ?></td>
                    </tr>
                </table>
            </div>

        <div class="related">
            <h3 class="staff"><?= __('Related Conversations') ?></h3>
            <?php if (!empty($user->conversations)) : ?>
            <div class="table-responsive">
                <table>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Rat Id') ?></th>
                        <th><?= __('Rattery Id') ?></th>
                        <th><?= __('Litter Id') ?></th>
                        <th><?= __('Created') ?></th>
                        <th><?= __('Modified') ?></th>
                        <th><?= __('Is Active') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->conversations as $conversations) : ?>
                    <tr>
                        <td><?= h($conversations->id) ?></td>
                        <td><?= h($conversations->rat_id) ?></td>
                        <td><?= h($conversations->rattery_id) ?></td>
                        <td><?= h($conversations->litter_id) ?></td>
                        <td><?= h($conversations->created) ?></td>
                        <td><?= h($conversations->modified) ?></td>
                        <td><?= h($conversations->is_active) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Conversations', 'action' => 'view', $conversations->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Conversations', 'action' => 'edit', $conversations->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Conversations', 'action' => 'delete', $conversations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conversations->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>
        </div>

        <div class="related">
            <h3 class="staff">Statistics</h3>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Current number of rats:') ?></th>
                    <td><?=
                        $alive_rat_count!=0 ?
                        h($alive_rat_count) . ' ' . __('rats') . ' (♀: ' . h($alive_female_count) . ', ♂: ' . h($alive_male_count) . ')' :
                        __('No rat at the moment')
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Total number of owned rats:') ?></th>
                    <td><?= h($rat_count) . ' ' . __('rats') ?> (♀: <?= h($female_count) ?>, ♂: <?= h($male_count) ?>) </td>
                </tr>
                <tr>
                    <th><?= __('Managed sheets (as owner or creator):') ?></th>
                    <td>
                        <?= h($rat_count+$managed_rat_count) . ' ' . __('rats') ?>
                        (<?= __('alive: ') . h($alive_rat_count+$alive_managed_rat_count) ?>)
                    </td>
                </tr>
            </table>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Average lifespan of their rats:') ?></th>
                    <td><?= h($avg_lifespan) . ' ' . __('months') ?> (♀: <?= h($female_avg_lifespan) ?>, ♂: <?= h($male_avg_lifespan) ?>) </td>
                    <tr>
                        <th> ⨽ average, infant mortality excluded:</th>
                        <td> ⨽ <?= h($not_infant_lifespan) . __(' months') ?> (♀: <?= h($not_infant_female_lifespan) ?>, ♂: <?= h($not_infant_male_lifespan) ?>)
                    </tr>
                    <tr>
                        <th> ⨽ average, accidents also excluded:</th>
                        <td> ⨽ <?= h($not_accident_lifespan) . __(' months') ?> (♀: <?= h($not_accident_female_lifespan) ?>, ♂: <?= h($not_accident_male_lifespan) ?>)
                    </tr>
                </tr>
            </table>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Their champion:') ?></th>
                    <td><?= empty($champion) ? 'This user has no eligible champion' : $this->Html->link(h($champion->usual_name),['controller' => 'Rats', 'action' => 'view', $champion->id]) . ' (' . h($champion->champion_age_string) .')'?></td>
                </tr>
            </table>
        </div>

        <div class="signature">
            &mdash; Created on <?= $user->created->i18nFormat('dd/MM/yyyy') ?>. <?= ($user->modified != $user->created) ? 'Last modified on ' . $user->modified->i18nFormat('dd/MM/yyyy') .'.' : '' ?>
        </div>

        </div>
    </div>
</div>
