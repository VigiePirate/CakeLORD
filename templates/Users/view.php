<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <?php if (! is_null($identity)) : ?>
                <?php if ($identity->can('edit', $user)) : ?>
                    <div class="side-nav-group">
                        <div class="tooltip">
                            <?= $this->Html->image('/img/icon-comment.svg', [
                                'url' => ['controller' => 'Users', 'action' => 'editComment', $user->id],
                                'class' => 'side-nav-icon',
                                'alt' => __('Edit Comment')]) ?>
                            <span class="tooltiptext"><?= __('Edit comment') ?></span>
                        </div>
                        <div class="tooltip">
                            <?= $this->Html->image('/img/icon-edit.svg', [
                                'url' => [
                                    'controller' => 'Users',
                                    'action' => 'edit', $user->id,
                                ],
                                'class' => 'side-nav-icon',
                                'alt' => __('Modify User')
                            ]) ?>
                            <span class="tooltiptext"><?= __('Edit whole user sheet') ?></span>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="side-nav-group">
                        <div class="tooltip disabled">
                            <?= $this->Html->image('/img/icon-comment.svg', [
                                'url' => [],
                                'class' => 'side-nav-icon',
                                'alt' => __('Edit Comment')]) ?>
                            <span class="tooltiptext"><?= __('You cannot edit the comment') ?></span>
                        </div>
                        <div class="tooltip disabled">
                            <?= $this->Html->image('/img/icon-edit.svg', [
                                'url' => [],
                                'class' => 'side-nav-icon',
                                'alt' => __('Modify User')
                            ]) ?>
                            <span class="tooltiptext"><?= __('You cannot edit this sheet') ?></span>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($show_staff) && $show_staff && ! is_null($identity) && $identity->is_staff) : ?>
                    <div class="side-nav-group">
                        <?= $this->element('staff_sidebar', [
                            'controller' => 'Users',
                            'object' => $user,
                            'user' => $identity
                            ])
                        ?>
                    </div>
                <?php endif; ?>
            <?php endif ; ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Owner') ?></div> <!-- h($user->role->name) -->
            </div>
            <h1><?= h($user->username) ?></h1>
            <div class="row row-with-photo">
                <div class="column-responsive column-66">

                    <h2><?= __('Information') ?></h2>
                    <table class="aside-photo">
                        <tr>
                            <th><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Role') ?></th>
                            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Localization') ?></th>
                            <td><?= h($user->localization) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Main rattery') ?></th>
                            <td><?= h($user->main_rattery_name) ?></td>
                        </tr>
                    </table>
                </div>

                <?php if (! is_null($identity) && $identity->can('changePicture', $user)) : ?>
                    <div class="column column-photo column-portrait edit-photo">
                        <?php if ($user->avatar != '' && $user->avatar != 'Unknown.png') : ?>
                            <?= $this->Html->image(UPLOADS . $user->avatar, ['alt' => $user->username, 'url' => ['action' => 'changePicture', $user->id]]) ?>
                        <?php else : ?>
                            <?= $this->Html->image('UnknownUser.svg', ['url' => ['action' => 'changePicture', $user->id]]) ?>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="column column-photo column-portrait">
                        <?php if ($user->avatar != '' && $user->avatar != 'Unknown.png') : ?>
                            <?= $this->Html->image(UPLOADS . $user->avatar, ['alt' => $user->username]) ?>
                        <?php else : ?>
                            <?= $this->Html->image('UnknownUser.svg') ?>
                        <?php endif; ?>
                    </div>
                <?php endif ; ?>
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

            <div class="related">
                <details open>
                    <summary><?= __('Ratteries') ?></summary>
                    <?php if (!empty($user->ratteries)) : ?>
                        <?= $this->element('simple_ratteries', [ //rats
                            'rubric' => __(''),
                            'ratteries' =>  $user->ratteries,
                            'exceptions' => [
                                'picture',
                                'owner_user',
                                'actions'
                            ],
                        ]) ?>
                    <?php else : ?>
                        <div class="message" onclick="this.classList.add('hidden')"><?= __('This user doesn’t have any rattery.') ?></div>
                    <?php endif; ?>
                </details>
            </div>

            <div class="related">
                <details open>
                    <summary><?= __('Last Modified Rats') ?></summary>
                    <?php if (!empty($user->owner_rats)) : ?>
                        <div class="button-raised">
                            <?= $this->Html->link(__('See all their rats'), ['controller' => 'Rats', 'action' => 'ownedBy', $user->username], ['class' => 'button float-right']) ?>
                        </div>
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
                    <?php else : ?>
                        <div class="message"><?= __('This user doesn’t have any rat.') ?></div>
                    <?php endif; ?>
                </details>
            </div>

            <div class="signature">
                &mdash; <?= __('Created on {0}.', [$user->created->i18nFormat('dd/MM/yyyy'), ]) ?>  <?= ($user->modified != $user->created) ? __('Last modified on {0}.', [$user->modified->i18nFormat('dd/MM/yyyy')]) : '' ?>
            </div>

        </div>

        <?= $this->element('lockbar') ?>

        <!-- Show private information to owner and staff only for now -->
        <?php if (!is_null($identity) && $identity->can('seePrivate', $user)) : ?>
            <div class="spacer"> </div>
            <div class="litter view content">
                <h2 class="staff"><?= __('Private information') ?></h2>
                <!-- Sensitive information, edit with care! -->
                <?php if ($identity->can('seeStaffOnly', $user)) :?>
                    <div class="related">
                        <h3 class='staff'><?= __('Staff Comments') ?></h3>
                        <div class="text">
                            <blockquote>
                                <?= $this->Text->autoParagraph(h($user->staff_comments)); ?>
                            </blockquote>
                        </div>
                    </div>
                <?php endif ;?>

                <!-- Sensitive information, edit with care! -->
                <?php if ($identity->can('accessPersonal', $user)) :?>
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
                            <th><?= __x('grammar', 'Grammatical Gender') ?></th>
                            <td><?= h($user->sex_string) ?></td>
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
                            <th><?= __('Wants Newsletter?') ?></th>
                            <td><?= $user->wants_newsletter ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Is Locked') ?></th>
                            <td><?= $user->is_locked ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                </div>
                <?php endif ;?>

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

                <?php if ($identity->can('seeStaffOnly', $user)) :?>
                <div class="related">
                    <h3 class="staff"><?= __('Statistics') ?></h3>
                    <table class="condensed stats">
                        <tr>
                            <th><?= __('Current number of rats:') ?></th>
                            <td><?=
                                $alive_rat_count!=0 ?
                                h($alive_rat_count) . ' ' . __('rats') . ' (♀: ' . h($alive_female_count) . ' – ♂: ' . h($alive_male_count) . ')' :
                                __('No rat at the moment')
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Total number of owned rats:') ?></th>
                            <td><?= h($rat_count) . ' ' . __('rats') ?> (♀: <?= h($female_count) ?> – ♂: <?= h($male_count) ?>) </td>
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
                            <td><?= __('{0, plural, =1{1 month} other{# months}}', [h($avg_lifespan)]) ?> (♀: <?= h($female_avg_lifespan) ?> – ♂: <?= h($male_avg_lifespan) ?>) </td>
                            <tr>
                                <th> ⨽ <?= __('average, infant mortality excluded:') ?></th>
                                <td> ⨽ <?= __('{0, plural, =1{1 month} other{# months}}', [h($not_infant_lifespan)]) ?> (♀: <?= h($not_infant_female_lifespan) ?> – ♂: <?= h($not_infant_male_lifespan) ?>)
                            </tr>
                            <tr>
                                <th> ⨽ <?= __('average, accidents also excluded:') ?></th>
                                <td> ⨽ <?= __('{0, plural, =1{1 month} other{# months}}', [h($not_accident_lifespan)]) ?> (♀: <?= h($not_accident_female_lifespan) ?> – ♂: <?= h($not_accident_male_lifespan) ?>)
                            </tr>
                        </tr>
                    </table>

                    <table class="condensed stats">
                        <tr>
                            <th><?= __('Their champion:') ?></th>
                            <td><?=
                                empty($champion)
                                ? __('This user has no eligible champion')
                                : $this->Html->link(h($champion->usual_name), ['controller' => 'Rats', 'action' => 'view', $champion->id], ['escape' => false]) . ' (' . h($champion->champion_age_string) .')'
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->Html->css('lockbar.css') ?>
