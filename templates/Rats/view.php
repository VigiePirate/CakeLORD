<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->assign('title', h($rat->usual_name)) ?>

<?php if (! $rat->state->is_visible && (is_null($user) || (! is_null($user) && ! $user->role->is_staff))) : ?>
    <div class="row">
        <aside class="column">
            <div class="side-nav">
                <div class="side-nav-group">
                    <?= $this->element('default_sidebar', ['help_url' => ['controller' => 'Categories', 'action' => 'view', 6]]) ?>
                </div>
                <div class="side-nav-group">
                    <div class="tooltip">
                        <?= $this->Html->image('/img/icon-back.svg', [
                            'url' => 'javascript:history.back()',
                            'class' => 'side-nav-icon',
                            'alt' => __('Back')]) ?>
                            <span class="tooltiptext"><?= __('Back') ?></span>
                        </div>
                </div>
            </div>
        </aside>

        <div class="column-responsive column-90">
            <div class="rats view content">
                <div class="sheet-heading">
                    <div class="sheet-title pretitle"><?= __('Rat') ?></div>
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($rat->state->name) ?></span>
                    </div>
                </div>

                <h1>
                    <?= h($rat->usual_name) . '<span class="sexcolor_' . h($rat->sex) . '"> ' . h($rat->sex_symbol) . '</span><span>' . h($rat->is_alive_symbol) . '</span>' ?>
                </h1>
                <div class="message error">
                    <?= __('Due to its state in back-office, this sheet can be viewed only by authorized people.') ?>
                </div>

                <div class="signature">
                    &mdash; <?= __('Created on {0} by {1}.', [$rat->created->i18nFormat('dd/MM/yyyy'), $rat->creator_user->username]) ?>  <?= ($rat->modified != $rat->created) ? __('Last modified on {0}.', [$rat->modified->i18nFormat('dd/MM/yyyy')]) : '' ?>
                </div>

            </div>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <aside class="column">
            <div class="side-nav">
                <div class="side-nav-group">
                    <?= $this->element('default_sidebar', ['help_url' => ['controller' => 'Categories', 'action' => 'view', 6]]) ?>
                </div>

                <?php if (! is_null($user)) : ?>
                    <div class="side-nav-group">
                        <?php if (! $user->can('microEdit', $rat)) : ?>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-transfer-ownership.svg', [
                                    'url' => [],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Change Owner')
                                ]) ?>
                                <span class="tooltiptext"><?= __('You cannot give this rat to another user') ?></span>
                            </div>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-add-litter.svg', [
                                    'url' => ['controller' => 'Litters', 'action' => 'add', $rat->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Declare Litter')]) ?>
                                <span class="tooltiptext"><?= __('Declare litter from this rat') ?></span>
                            </div>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-comment.svg', [
                                    'url' => [],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Edit Comment')]) ?>
                                <span class="tooltiptext"><?= __('You cannot edit the comment') ?></span>
                            </div>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-declare-death.svg', [
                                    'url' => [],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Declare Rat Death')
                                ]) ?>
                                <span class="tooltiptext"><?= __('You cannot declare this rat’s death') ?></span>
                            </div>
                        <?php else : ?>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-transfer-ownership.svg', [
                                    'url' => ['controller' => 'Rats', 'action' => 'transferOwnership', $rat->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Change Owner')]) ?>
                                <span class="tooltiptext"><?= __('Give rat to a new owner') ?></span>
                            </div>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-add-litter.svg', [
                                    'url' => ['controller' => 'Litters', 'action' => 'add', $rat->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Declare Litter')]) ?>
                                <span class="tooltiptext"><?= __('Declare litter from this rat') ?></span>
                            </div>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-comment.svg', [
                                    'url' => ['controller' => 'Rats', 'action' => 'editComment', $rat->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Edit Comment')]) ?>
                                <span class="tooltiptext"><?= __('Edit comment') ?></span>
                            </div>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-declare-death.svg', [
                                    'url' => ['controller' => 'Rats', 'action' => 'declareDeath', $rat->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Declare Rat Death')]) ?>
                                <span class="tooltiptext"><?= __('Declare rat death') ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (! $user->can('ownerEdit', $rat)) : ?>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-edit.svg', [
                                    'url' => [],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Edit Rat')
                                ]) ?>
                                <span class="tooltiptext"><?= __('You cannot edit this sheet') ?></span>
                            </div>
                        <?php else : ?>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-edit.svg', [
                                    'url' => [
                                        'controller' => 'Rats',
                                        'action' => 'edit', $rat->id,
                                    ],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Edit Rat')
                                ]) ?>
                                <span class="tooltiptext"><?= __('Edit whole rat sheet') ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($rat->state->is_reliable) : ?>
                            <div class="tooltip">
                                <?= $this->Html->link(
                                        $this->Html->image('/img/icon-print.svg', ['class' => 'side-nav-icon', 'alt' => __('Print')]),
                                        ['controller' => 'Rats', 'action' => 'print', $rat->id],
                                        ['target' => '_blank', 'escape' => false, 'class' => "hide-on-mobile"]
                                    )
                                ?>
                                <span class="tooltiptext"><?= __('Print pedigree') ?></span>
                            </div>
                        <?php else : ?>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-print.svg', [
                                    'url' => [],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Print pedigree')
                                ]) ?>
                                <span class="tooltiptext"><?= __('You cannot print a pedigree for this rat') ?></span>
                            </div>
                        <?php endif ;?>
                    </div>

                    <?php if ($user->is_staff) : ?>
                        <div class="side-nav-group">
                            <?= $this->element('staff_sidebar', [
                                'controller' => 'Rats',
                                'object' => $rat,
                                'user' => $user
                                ])
                            ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </aside>

        <div class="column-responsive column-90">
            <div class="rats view content">
                <div class="sheet-heading">
                    <div class="sheet-title pretitle"><?= __('Rat') ?></div>
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($rat->state->name) ?></span>
                    </div>
                </div>

                <h1>
                    <!-- to be improved -->
                    <?= h($rat->usual_name) . '<span class="sexcolor_' . h($rat->sex) . '"> ' . h($rat->sex_symbol) . '</span><span>' . h($rat->is_alive_symbol) . '</span>' ?>
                </h1>

                <!-- special highlighted subtitle if the sheet needs user action -->
                <?php if ($rat->state->needs_user_action && ! is_null($user) && $user->can('ownerEdit', $rat)) : ?>
                    <div class="message error">
                        <p><?= __('This sheet needs correction. Here is the latest message staff sent you about it.') ?></p>
                        <div class="text">
                            <blockquote>
                                <?= ! empty($last_staff_message) ? nl2br($last_staff_message->content) : __('No explaining notification available.') ?>
                            </blockquote>
                        </div>
                        <p>
                            <?=
                                __('Please take action to comply with staff requirements. You may use the most appropriate action from the action bar to modify the sheet. If you are not sure, you can <a href={0} class="flash">edit the full sheet</a>, or <a href={1} class="flash">answer and send the sheet back to staff</a>.',
                                [
                                    $this->Url->build(['controller' => 'Rats', 'action' => 'edit', $rat->id]),
                                    $this->Url->build(['controller' => 'Rats', 'action' => 'dispute', $rat->id])
                                ])
                            ?>
                        </p>
                    </div>
                <?php endif ;?>

                <!-- special highlighted subtitle if the sheet is not reliable -->
                <?php if (! $rat->state->needs_user_action && $rat->state->is_frozen && ! $rat->state->is_reliable) : ?>
                    <?php if ($rat->state->is_visible) : ?>
                        <div class="message error">
                            <p><?= __('This sheet contains incomplete, incoherent or dubious information. Find the staff explanation below.') ?></p>
                            <div class="text">
                                <blockquote>
                                    <?= ! is_null($last_staff_message) ? nl2br($last_staff_message->content) : __('No explaining notification available.') ?>
                                </blockquote>
                            </div>
                            <p><?= __('The sheet is displayed “as is” for transparency purpose, but it cannot be considered as reliable.') ?></p>
                        </div>
                    <?php else :?>
                        <div class="message error">
                            <?= __('This sheet contains incomplete, incoherent or dubious information. It is only visible to staff members.') ?>
                        </div>
                    <?php endif ; ?>
                <?php endif ;?>

                <div class="row row-reverse row-with-photo">
                    <div class="column-responsive column-60">
                        <h2><?= __('Identity') ?></h2>
                        <table class="aside-photo">
                            <tr>
                                <th><?= __('Identifier') ?></th>
                                <td><?= h($rat->pedigree_identifier) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Name') ?></th>
                                <td><?= h($rat->name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Pup name') ?></th>
                                <td><?= h($rat->pup_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Birth date') ?></th>
                                <td><?= ucfirst(h($rat->birth_date->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::NONE]))) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Sex') ?></th>
                                <td><?= h($rat->sex_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Owner') ?></th>
                                <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                            </tr>
                        </table>
                    </div>

                    <?php if (! is_null($user) && $user->can('microEdit', $rat)) : ?>
                        <div class="column column-photo edit-photo">
                            <?php if ($rat->picture != '' && $rat->picture != 'Unknown.png') : ?>
                                <?= $this->Html->image(UPLOADS . $rat->picture, ['alt' => $rat->pedigree_identifier, 'url' => ['action' => 'changePicture', $rat->id]]) ?>
                            <?php else : ?>
                                <?= $this->Html->image('UnknownRat.svg', ['url' => ['action' => 'changePicture', $rat->id]]) ?>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <div class="column column-photo">
                            <?php if ($rat->picture != '' && $rat->picture != 'Unknown.png') : ?>
                                <?= $this->Html->image(UPLOADS . $rat->picture, ['alt' => $rat->pedigree_identifier]) ?>
                            <?php else : ?>
                                <?= $this->Html->image('UnknownRat.svg') ?>
                            <?php endif; ?>
                        </div>
                    <?php endif ; ?>

                </div>
                <h2><?= __('Origins') ?></h2>
                    <table class="condensed unfold">
                        <tr>
                            <th><?= __('Birth place') ?></th>
                            <td><?= $rat->has('rattery') ? $this->Html->link($rat->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $rat->rattery->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Dam') ?></th>
                            <!-- Display field should be better managed (dagger and age in a "full name with age" field) -->
                            <td><?= $rat->has('birth_litter')
                                ? $this->Html->link(
                                        $rat->birth_litter->dam[0]->usual_name,
                                        ['controller' => 'Rats', 'action' => 'view', $rat->birth_litter->dam[0]->id]
                                    ) . '<sup>' . $rat->birth_litter->dam[0]->is_alive_symbol . '</sup>'
                                    . ' (' . $rat->birth_litter->dam[0]->age_string . ')'
                                : __x('mother', 'Unknown or unregistered')
                                ?>
                                </td>
                        </tr>
                        <tr>
                            <th><?= __('Sire') ?></th>
                            <td><?= ($rat->has('birth_litter') && ! empty($rat->birth_litter->sire))
                                ? $this->Html->link(
                                        $rat->birth_litter->sire[0]->usual_name,
                                        ['controller' => 'Rats', 'action' => 'view', $rat->birth_litter->sire[0]->id]
                                    ) . '<sup>' . $rat->birth_litter->sire[0]->is_alive_symbol . '</sup>' . ' (' . $rat->birth_litter->sire[0]->age_string  . ')'
                                : __x('father', 'Unknown or unregistered') ?>
                                </td>
                        </tr>
                        <tr>
                            <th><?= __('Genealogy') ?></th>
                            <td><?= $rat->has('birth_litter') ? $this->Html->link(__('See birth litter sheet'), ['controller' => 'Litters', 'action' => 'view', $rat->birth_litter->id]) . __(' (parents and siblings)') : __('Not attached to any litter') ?></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><?= $this->Html->link(__('See interactive family tree'), ['controller' => 'Rats', 'action' => 'pedigree', $rat->id]) ?> <?= __('(all direct ascendants and descendants)') ?></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><?= $this->Html->link(__('See family report'), ['controller' => 'Rats', 'action' => 'family', $rat->id]) ?> <?= __('(family size and lifespan statistics)') ?></td>
                        </tr>
                    </table>

                <h2><?= __('Description') ?></h2>
                    <table class="condensed">
                        <tr>
                            <th><?= __('Variety') ?></th>
                            <td><?= $rat->variety ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Color') ?></th>
                            <td><?= $rat->has('color') ? $this->Html->link($rat->color->name, ['controller' => 'Colors', 'action' => 'view', $rat->color->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Dilution') ?></th>
                            <td><?= $rat->has('dilution') ? $this->Html->link($rat->dilution->name, ['controller' => 'Dilutions', 'action' => 'view', $rat->dilution->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Marking') ?></th>
                            <td><?= $rat->has('marking') ? $this->Html->link($rat->marking->name, ['controller' => 'Markings', 'action' => 'view', $rat->marking->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Earset') ?></th>
                            <td><?= $rat->has('earset') ? $this->Html->link($rat->earset->name, ['controller' => 'Earsets', 'action' => 'view', $rat->earset->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Coat') ?></th>
                            <td><?= $rat->has('coat') ? $this->Html->link($rat->coat->name, ['controller' => 'Coats', 'action' => 'view', $rat->coat->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Eyecolor') ?></th>
                            <td><?= $rat->has('eyecolor') ? $this->Html->link($rat->eyecolor->name, ['controller' => 'Eyecolors', 'action' => 'view', $rat->eyecolor->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Singularities') ?></th>
                            <td>
                                <?php
                                    $link_array = [];
                                    foreach($rat->singularities as $singularity) {
                                        array_push($link_array, $this->Html->link($singularity->name, ['controller' => 'Singularities', 'action' => 'view', $singularity->id]));
                                    }
                                    $string = empty($link_array) ? __x('singularity', 'None') : implode(", ", $link_array);
                                    echo $string;
                                ?>
                            </td>
                        </tr>
                    </table>

                <h2><?= __('Health') ?></h2>
                <table class="condensed unfold">
                    <tr>
                        <th><?= __('Is alive?') ?></th>
                        <td><?= $rat->is_alive ? __('Yes') : __('No'); ?></td>
                    </tr>
                    <tr>
                        <th><?= $rat->is_alive ? __('Age') : __('Age at death'); ?></th>
                        <td><?= h($rat->age_string) ?></td>
                    </tr>
                    <?php if (! $rat->is_alive && (! $rat->has('death_secondary_cause') || $rat->death_secondary_cause->id != '1')) : ?>
                        <tr>
                            <th><?= __('Death date') ?></th>
                            <td><?= $rat->has('death_date') ? h($rat->death_date->i18nFormat('dd/MM/yyyy')) : __('Unknown') ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if (!$rat->is_alive) : ?>
                        <tr>
                            <th><?= __('Death category') ?></th>
                            <td><?= $rat->has('death_primary_cause') ? $this->Html->link($rat->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $rat->death_primary_cause->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Death cause') ?></th>
                            <td><?= $rat->has('death_secondary_cause') ? $this->Html->link($rat->death_secondary_cause->name, ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $rat->death_secondary_cause->id]) : __x('death_cause', 'Not Available') ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if (! $rat->is_alive && (!$rat->has('death_secondary_cause') || $rat->death_secondary_cause->id != '1')) : ?>
                        <tr>
                            <th><?= __('Euthanized?') ?></th>
                            <td><?= $rat->death_euthanized_string ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Diagnosed by vet?') ?></th>
                            <td><?= $rat->death_diagnosed_string ?></td>
                            </tr>
                        <tr>
                            <th><?= __('Post-mortem analyses?') ?></th>
                            <td><?= $rat->death_necropsied_string ?></td>
                        </tr>
                    <?php endif; ?>
                </table>

                <?php if (! is_null($rat->comments) && $rat->comments != '') : ?>
                    <h2><?= __('Comments') ?></h2>
                    <div class="text">
                        <blockquote>
                            <div class="markdown">
                                <?= $this->Commonmark->sanitize($rat->comments); ?>
                            </div>
                        </blockquote>
                    </div>
                    <div class="spacer"> </div>
                <?php endif; ?>

                <?php if (count($rat->bred_litters) > 0) : ?>
                    <h2><?= __('Bred litters') ?></h2>

                    <div class="related">
                        <?php foreach ($rat->bred_litters as $litter) : ?>
                            <details>
                                <summary>
                                    <?php if($rat->sex === 'M') { echo $litter->name_from_sire ; } else { echo $litter->name_from_dam ; } ?>
                                </summary>
                                <div class="button-raised">
                                    <?= $this->Html->link(__('See litter'), ['controller' => 'Litters', 'action' => 'view', $litter->id], ['class' => 'button float-right']) ?>
                                </div>
                                <?= $this->element('simple_rats', [ //rats
                                    'rubric' => __(''),
                                    'rats' => $litter->offspring_rats,
                                    'exceptions' => [
                                        'picture',
                                        'birth_date',
                                        'sire',
                                        'dam',
                                    ],
                                ]) ?>
                            </details>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="signature">
                    &mdash; <?= __('Created on {0} by {1}.', [$rat->created->i18nFormat('dd/MM/yyyy'), $rat->creator_user->username]) ?>  <?= ($rat->modified != $rat->created) ? __('Last modified on {0}.', [$rat->modified->i18nFormat('dd/MM/yyyy')]) : '' ?>
                </div>
            </div>

            <?= $this->element('statebar', ['sheet' => $rat, 'user' => $user]) ?>

            <!-- Show private information to owner and staff only -->
            <?php if (!is_null($user) && $user->can('seePrivate', $rat)) : ?>
                <div class="spacer"> </div>
                <div class="rat view content">
                    <h2 class="staff"><?= __('Private information') ?></h2>
                    <div class="related">
                        <details>
                            <summary class="staff">
                                <?= __('Messages') ?>
                            </summary>
                            <?php if (!empty($rat->rat_messages)) : ?>

                            <div class="table-responsive">
                                <table class="summary">
                                    <thead>
                                        <th><?= __x('message', 'Created') ?></th>
                                        <th><?= __x('message', 'Sent by') ?></th>
                                        <th><?= __('Message') ?></th>
                                        <th><?= __('Auto?') ?></th>
                                    </thead>
                                    <?php foreach ($rat->rat_messages as $message) : ?>
                                    <tr>
                                        <td class="nowrap"><?= h($message->created->i18nFormat('dd/MM/yyyy HH:mm')) ?></td>
                                        <td><?= h($message->user->username) ?></td>
                                        <td><?= h($message->content) ?></td>
                                        <td>
                                            <!-- <?php if (! is_null($user) && $user->can('delete', $message)) : ?>
                                                <?= $this->Html->image('/img/icon-delete.svg', [
                                                    'url' => ['controller' => 'RatMessages', 'action' => 'delete', $message->id],
                                                    'class' => 'action-icon',
                                                    'alt' => __('Delete Message')
                                                ])?>
                                            <?php else :?>
                                                <span class="disabled">
                                                    <?= $this->Html->image('/img/icon-delete.svg', [
                                                        'url' => '',
                                                        'class' => 'action-icon disabled',
                                                        'alt' => __('Delete Message')])
                                                    ?>
                                                </span>
                                            <?php endif ;?> -->
                                            <?= $message->is_automatically_generated ? '✓' : ''  ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                            <?php endif; ?>
                        </details>

                        <?php if (! is_null($user) and $user->can('restore', $rat)) : ?>
                            <details>
                                <summary class="staff">
                                    <?= __('Snapshots') ?>
                                </summary>
                                <?php if (!empty($rat->rat_snapshots)) : ?>
                                <div class="table-responsive">
                                    <table class="summary">
                                        <thead>
                                            <th><?= __('Created') ?></th>
                                            <th><?= __('Differences with current version') ?></th>
                                            <!-- <th><?= __('Data') ?></th> -->
                                            <th><?= __('State') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                        </thead>
                                        <?php foreach ($rat->rat_snapshots as $ratSnapshots) : ?>
                                        <tr>
                                            <td><?= h($ratSnapshots->created) ?></td>
                                            <td><?= h($snap_diffs[$ratSnapshots->id]) ?></td>
                                            <td><span class="statecolor_<?php echo h($ratSnapshots->state_id) ?>"><?= h($ratSnapshots->state->symbol) ?></span></td>
                                            <td class="actions">
                                                <span class="nowrap">
                                                    <?= $this->Html->image('/img/icon-diff.svg', [
                                                        'url' => ['controller' => 'RatSnapshots', 'action' => 'diff', $ratSnapshots->id],
                                                        'class' => 'action-icon',
                                                        'alt' => __('Compare Versions')])
                                                    ?>
                                                    <?= $this->Html->image('/img/icon-restore.svg', [
                                                        'url' => ['controller' => 'Rats', 'action' => 'restore', $rat->id, $ratSnapshots->id],
                                                        'class' => 'action-icon',
                                                        'alt' => __('Restore Snapshot')]) ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <?php endif; ?>
                            </details>
                        <?php endif ; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?= $this->Html->css('statebar.css') ?>
