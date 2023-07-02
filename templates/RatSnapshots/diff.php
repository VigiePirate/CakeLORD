<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <div class="column-responsive column-50">
        <div class="rats view content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= _('Snapshot') ?></div>
                <?php if (in_array('state_id', $diff_list)) : ?>
                    <div class="minus current-statemark statecolor_<?php echo h($snapshot->state_id) ?>"><?= h($snapshot->state->symbol) ?></div>
                <?php else : ?>
                    <div class="current-statemark statecolor_<?php echo h($snapshot->state_id) ?>"><?= h($snapshot->state->symbol) ?></div>
                <?php endif ; ?>
            </div>

            <h1>
                <?= h($snap_rat->usual_name) . '<span class="sexcolor_' . h($snap_rat->sex) . '"> ' . h($snap_rat->sex_symbol) . '</span><span>' . h($snap_rat->is_alive_symbol) . '</span>' ?>
            </h1>

            <div class="column column-photo half-column-photo">
            <?php if ($rat->picture != '' && $rat->picture != 'Unknown.png') : ?>
                <?= $this->Html->image(UPLOADS . $snap_rat->picture, ['alt' => $rat->pedigree_identifier, 'url' => ['controller' => 'rats', 'action' => 'view', $rat->id]]) ?>
            <?php else : ?>
                <?= $this->Html->image('UnknownRat.svg', ['alt' => $rat->pedigree_identifier, 'url' => ['controller' => 'rats', 'action' => 'view', $rat->id]]) ?>
            <?php endif; ?>
            </div>

            <h2><?= __('Identity') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Identifier') ?></th>
                    <?php if (in_array('pedigree_identifier', $diff_list)) : ?>
                        <td class="minus"><?= h($snap_rat->pedigree_identifier) ?></td>
                    <?php else : ?>
                        <td><?= h($rat->pedigree_identifier) ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <?php if (in_array('name', $diff_list)) : ?>
                        <td class="minus"><?= h($snap_rat->name) ?></td>
                    <?php else : ?>
                        <td><?= h($rat->name) ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Pup name') ?></th>
                    <?php if (in_array('pup_name', $diff_list)) : ?>
                        <td class="minus"><?= h($snap_rat->pup_name) ?></td>
                    <?php else : ?>
                        <td><?= h($rat->pup_name) ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Birth date') ?></th>
                    <?php if (in_array('birth_date', $diff_list)) : ?>
                        <td class="minus"><?= h($snap_rat->birth_date->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::NONE])) ?></td>
                    <?php else : ?>
                        <td><?= h($rat->birth_date->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::NONE])) ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Sex') ?></th>
                    <?php if (in_array('sex', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->sex_name ?></td>
                    <?php else : ?>
                        <td><?= h($rat->sex_name) ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Owner') ?></th>
                    <?php if (in_array('owner_user_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('owner_user') ? $this->Html->link($snap_rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $snap_rat->owner_user->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                    <?php endif ; ?>
                </tr>
            </table>

            <h2><?= __('Origins') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Birth place') ?></th>

                    <?php if (in_array('birth_place', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('rattery') ? $this->Html->link($snap_rat->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $snap_rat->rattery->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('rattery') ? $this->Html->link($rat->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $rat->rattery->id]) : '' ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Birth litter') ?></th>
                    <?php if (in_array('birth_litter_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('birth_litter') ? $this->Html->link($snap_rat->birth_litter->parents_name, ['controller' => 'Litters', 'action' => 'view', $snap_rat->birth_litter->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('birth_litter') ? $this->Html->link($rat->birth_litter->parents_name, ['controller' => 'Litters', 'action' => 'view', $rat->birth_litter->id]) : __x('litter', 'None') ?></td>
                    <?php endif ; ?>
                </tr>
            </table>

            <h2><?= __('Description') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Color') ?></th>
                    <?php if (in_array('color_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('color') ? $this->Html->link($snap_rat->color->name, ['controller' => 'Colors', 'action' => 'view', $snap_rat->color->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('color') ? $this->Html->link($rat->color->name, ['controller' => 'Colors', 'action' => 'view', $rat->color->id]) : '' ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Eyecolor') ?></th>
                    <?php if (in_array('eyecolor_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('eyecolor') ? $this->Html->link($snap_rat->eyecolor->name, ['controller' => 'Eyecolors', 'action' => 'view', $snap_rat->eyecolor->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('eyecolor') ? $this->Html->link($rat->eyecolor->name, ['controller' => 'Eyecolors', 'action' => 'view', $rat->eyecolor->id]) : '' ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Dilution') ?></th>
                    <?php if (in_array('color_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('dilution') ? $this->Html->link($snap_rat->dilution->name, ['controller' => 'Dilutions', 'action' => 'view', $snap_rat->dilution->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('dilution') ? $this->Html->link($rat->dilution->name, ['controller' => 'Dilutions', 'action' => 'view', $rat->dilution->id]) : '' ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Marking') ?></th>
                    <?php if (in_array('marking_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('marking') ? $this->Html->link($snap_rat->marking->name, ['controller' => 'Markings', 'action' => 'view', $snap_rat->marking->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('marking') ? $this->Html->link($rat->marking->name, ['controller' => 'Markings', 'action' => 'view', $rat->marking->id]) : '' ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Earset') ?></th>
                    <?php if (in_array('earset_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('earset') ? $this->Html->link($snap_rat->earset->name, ['controller' => 'Earsets', 'action' => 'view', $snap_rat->earset->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('earset') ? $this->Html->link($rat->earset->name, ['controller' => 'Earsets', 'action' => 'view', $rat->earset->id]) : '' ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Coat') ?></th>
                    <?php if (in_array('coat_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('coat') ? $this->Html->link($snap_rat->coat->name, ['controller' => 'Coats', 'action' => 'view', $snap_rat->coat->id]) : '' ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('coat') ? $this->Html->link($rat->coat->name, ['controller' => 'Coats', 'action' => 'view', $rat->coat->id]) : '' ?></td>
                    <?php endif ; ?>
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
            <table class="condensed stats">
                <tr>
                    <th><?= __('Is alive?') ?></th>
                    <?php if (in_array('is_alive', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->is_alive ? __('Yes') : __('No'); ?></td>
                    <?php else : ?>
                        <td><?= $rat->is_alive ? __('Yes') : __('No'); ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <?php if (in_array('death_date', $diff_list)) : ?>
                        <th><?= $snap_rat->is_alive ? __('Age') : __('Age at death'); ?></th>
                        <td class="minus"><?= h($snap_rat->age_string) ?></td>
                    <?php else : ?>
                        <th><?= $snap_rat->is_alive ? __('Age') : __('Age at death'); ?></th>
                        <td><?= h($snap_rat->age_string) ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Death date') ?></th>
                    <?php if (in_array('death_date', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('death_date') ? h($snap_rat->death_date->i18nFormat('dd/MM/yyyy')) : __('N/A') ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('death_date') ? h($rat->death_date->i18nFormat('dd/MM/yyyy')) : __('N/A') ?></td>
                    <?php endif ; ?>
                </tr>

                <tr>
                    <th><?= __('Death category') ?></th>
                    <?php if (in_array('death_primary_cause_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('death_primary_cause') ? $this->Html->link($snap_rat->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $snap_rat->death_primary_cause->id]) : __('N/A') ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('death_primary_cause') ? $this->Html->link($rat->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $rat->death_primary_cause->id]) : __('N/A') ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Death cause') ?></th>
                    <?php if (in_array('death_secondary_cause_id', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->has('death_secondary_cause') ? $this->Html->link($snap_rat->death_secondary_cause->name, ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $snap_rat->death_secondary_cause->id]) : __('N/A') ?></td>
                    <?php else : ?>
                        <td><?= $rat->has('death_secondary_cause') ? $this->Html->link($rat->death_secondary_cause->name, ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $rat->death_secondary_cause->id]) : __('N/A') ?></td>
                    <?php endif ; ?>
                </tr>

                <tr>
                    <th><?= __('Euthanized?') ?></th>
                    <?php if (in_array('death_euthanized', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->death_euthanized ? __('Yes') : __('No'); ?></td>
                    <?php else : ?>
                        <td><?= $rat->death_euthanized ? __('Yes') : __('No'); ?></td>
                    <?php endif ; ?>
                </tr>
                <tr>
                    <th><?= __('Diagnosed by vet?') ?></th>
                    <?php if (in_array('death_diagnosed', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->death_diagnosed ? __('Yes') : __('No'); ?></td>
                    <?php else : ?>
                        <td><?= $rat->death_diagnosed ? __('Yes') : __('No'); ?></td>
                    <?php endif ; ?>
                    </tr>
                <tr>
                    <th><?= __('Post-mortem analyses?') ?></th>
                    <?php if (in_array('death_necropsied', $diff_list)) : ?>
                        <td class="minus"><?= $snap_rat->death_necropsied ? __('Yes') : __('No'); ?></td>
                    <?php else : ?>
                        <td><?= $rat->death_necropsied ? __('Yes') : __('No'); ?></td>
                    <?php endif ; ?>
                </tr>
            </table>

            <h2><?= __('Comments') ?></h2>

            <?php if (in_array('comments', $diff_list)) : ?>
                <div class="text minus">
                    <blockquote>
                        <div class="markdown">
                            <?= $this->Commonmark->sanitize($snap_rat->comments); ?>
                        </div>
                    </blockquote>
                </div>
            <?php else : ?>
                <div class="text">
                    <blockquote>
                        <div class="markdown">
                            <?= $this->Commonmark->sanitize($rat->comments); ?>
                        </div>
                    </blockquote>
                </div>
            <?php endif ; ?>

            <div class="signature">
                &mdash; <?= __('Created on {0} by {1}.', [$rat->created->i18nFormat('dd/MM/yyyy'), $rat->creator_user->username]) ?>
            </div>
        </div>

    </div>

    <div class="column-responsive column-50">
        <div class="rats view content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= _('Rat') ?></div>
                <?php if (in_array('state_id', $diff_list)) : ?>
                    <div class="plus current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                <?php else : ?>
                    <div class="current-statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                <?php endif ; ?>
            </div>

            <h1>
                <!-- to be improved -->
                <?= h($rat->usual_name) . '<span class="sexcolor_' . h($rat->sex) . '"> ' . h($rat->sex_symbol) . '</span><span>' . h($rat->is_alive_symbol) . '</span>' ?>
            </h1>

            <div class="column column-photo half-column-photo">
            <?php if ($rat->picture != '' && $rat->picture != 'Unknown.png') : ?>
                <?= $this->Html->image(UPLOADS . $rat->picture, ['alt' => $rat->pedigree_identifier, 'url' =>  ['controller' => 'rats', 'action' => 'view', $rat->id]]) ?>
            <?php else : ?>
                <?= $this->Html->image('UnknownRat.svg', ['alt' => $rat->pedigree_identifier, 'url' => ['controller' => 'rats', 'action' => 'view', $rat->id]]) ?>
            <?php endif; ?>
            </div>

            <h2><?= __('Identity') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Identifier') ?></th>
                    <?php if (in_array('pedigree_identifier', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rat->pedigree_identifier) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <?php if (in_array('name', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rat->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pup name') ?></th>
                    <?php if (in_array('pup_name', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rat->pup_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth date') ?></th>
                    <?php if (in_array('birth_date', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rat->birth_date->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::NONE])) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sex') ?></th>
                    <?php if (in_array('sex', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rat->sex_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Owner') ?></th>
                    <?php if (in_array('owner_user_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                </tr>
            </table>

            <h2><?= __('Origins') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Birth place') ?></th>
                    <?php if (in_array('rattery_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('rattery') ? $this->Html->link($rat->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $rat->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth litter') ?></th>
                    <?php if (in_array('birth_litter_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('birth_litter') ? $this->Html->link($rat->birth_litter->parents_name, ['controller' => 'Litters', 'action' => 'view', $rat->birth_litter->id]) : __x('litter', 'None') ?></td>
                </tr>
            </table>

            <h2><?= __('Description') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Color') ?></th>
                    <?php if (in_array('color_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('color') ? $this->Html->link($rat->color->name, ['controller' => 'Colors', 'action' => 'view', $rat->color->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Eyecolor') ?></th>
                    <?php if (in_array('eyecolor_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('eyecolor') ? $this->Html->link($rat->eyecolor->name, ['controller' => 'Eyecolors', 'action' => 'view', $rat->eyecolor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Dilution') ?></th>
                    <?php if (in_array('dilution_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('dilution') ? $this->Html->link($rat->dilution->name, ['controller' => 'Dilutions', 'action' => 'view', $rat->dilution->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Marking') ?></th>
                    <?php if (in_array('marking_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= $rat->has('marking') ? $this->Html->link($rat->marking->name, ['controller' => 'Markings', 'action' => 'view', $rat->marking->id]) : '' ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Earset') ?></th>
                    <?php if (in_array('earset_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('earset') ? $this->Html->link($rat->earset->name, ['controller' => 'Earsets', 'action' => 'view', $rat->earset->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Coat') ?></th>
                    <?php if (in_array('coat_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('coat') ? $this->Html->link($rat->coat->name, ['controller' => 'Coats', 'action' => 'view', $rat->coat->id]) : '' ?></td>
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
            <table class="condensed stats">
                <tr>
                    <th><?= __('Is alive?') ?></th>
                    <?php if (in_array('is_alive', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->is_alive ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= $rat->is_alive ? __('Age') : __('Age at death'); ?></th>
                    <?php if (in_array('death_date', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= h($rat->age_string) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death date') ?></th>
                    <?php if (in_array('death_date', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('death_date') ? h($rat->death_date->i18nFormat('dd/MM/yyyy')) : __('N/A') ?></td>
                </tr>

                <tr>
                    <th><?= __('Death category') ?></th>
                    <?php if (in_array('death_primary_cause_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('death_primary_cause') ? $this->Html->link($rat->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $rat->death_primary_cause->id]) : __('N/A') ?></td>
                </tr>
                <tr>
                    <th><?= __('Death cause') ?></th>
                    <?php if (in_array('death_secondary_cause_id', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->has('death_secondary_cause') ? $this->Html->link($rat->death_secondary_cause->name, ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $rat->death_secondary_cause->id]) : __('N/A') ?></td>
                </tr>

                <tr>
                    <th><?= __('Euthanized?') ?></th>
                    <?php if (in_array('death_euthanized', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->death_euthanized ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Diagnosed by vet?') ?></th>
                    <?php if (in_array('death_diagnosed', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->death_diagnosed ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Post-mortem analyses?') ?></th>
                    <?php if (in_array('death_necropsied', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                    <?= $rat->death_necropsied ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

            <h2><?= __('Comments') ?></h2>
            <?php if (in_array('comments', $diff_list)) : ?>
                <div class="text plus">
            <?php else : ?>
                <div class="text">
            <?php endif ; ?>
                <blockquote>
                    <div class="markdown">
                        <?= $this->Commonmark->sanitize($rat->comments); ?>
                    </div>
                </blockquote>
            </div>

            <div class="signature">
                &mdash; <?= ($rat->modified != $rat->created) ? __('Last modified on {0}.', [$rat->modified->i18nFormat('dd/MM/yyyy')]) : '' ?>
            </div>
        </div>
    </div>
</div>

<div class="spacer"></div>

<div class="row">

    <div class="column-responsive column-50">
        <div class="tooltip-staff">
            <?= $this->Html->image('/img/icon-restore.svg', [
                'url' => ['controller' => 'rats', 'action' => 'restore', $rat->id, $snapshot->id],
                'class' => 'side-nav-icon restore-icon',
                'alt' => __('Restore')]) ?>
            <span class="tooltiptext-staff"><?= __('Restore') ?></span>
        </div>
    </div>

    <div class="column-responsive column-50">
        <div class="sheet-markers float-right mini-statebar">
            <?= $this->element('simple_statebar', ['controller' => 'Rats', 'sheet' => $rat, 'user' => $user]) ?>
        </div>
    </div>
</div>


<?= $this->Html->css('statebar.css') ?>
