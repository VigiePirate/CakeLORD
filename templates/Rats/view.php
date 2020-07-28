<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav">
                <?= $this->Html->image('/img/icon-fa-alert.svg', [
                    'url' => ['controller' => 'Conversations', 'action' => 'add'],
                    'class' => 'side-nav-icon',
                    'alt' => __('Report')]) ?>
                <?= $this->Html->image('/img/icon-help.svg', [
                    'url' => ['controller' => 'Articles', 'action' => 'index'],
                    'class' => 'side-nav-icon',
                    'alt' => __('Help')]) ?>
                <div class="spacer"> </div>
                <?= $this->Html->image('/img/icon-file-edit.svg', [
                    'url' => ['controller' => 'Rats', 'action' => 'edit', $rat->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Modify Rat')]) ?>
                    <?= $this->Html->image('/img/icon-fa-give.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'transferOwnership', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Change Owner')]) ?>
                <?= $this->Html->image('/img/icon-fa-baby.svg', [
                    'url' => ['controller' => 'Litters', 'action' => 'add'], //pass rattery id as contributor ? $rattery->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Declare Litter')]) ?>
                    <?= $this->Html->image('/img/icon-rip.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'declareDeath', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Declare Rat Death')]) ?>
                <div class="spacer"> </div>
                <?= $this->Html->image('/img/icon-edit-admin.svg', [
                    'url' => ['controller' => 'Rats', 'action' => 'edit', $rat->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Edit Rat as Admin')]) ?>
                <?= $this->Html->image('/img/icon-fa-trash.svg', [
                    'class' => 'side-nav-icon',
                    'alt' => __('Delete Rat')]) ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats view content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle">Rat</div>
                <div class="sheet-markers">
                    <div class="sexmark sexcolor_<?php echo h($rat->sex) ?>"><?= h($rat->sex_symbol) ?></div>
                    <div class="statemark statecolor_<?php echo h($rat->state_id) ?>"><?= h($rat->state->symbol) ?></div>
                </div>
            </div>

            <h1><?= h($rat->usual_name) . '<span>' . h($rat->is_alive_symbol) . '</span>' ?></h1>

            <div class="row row-reverse">
                <?php if ($rat->picture != '') : ?>
                <div class="column-responsive column-66">
                    <h2>Identity</h2>
                    <table class="condensed stats">
                <?php else : ?>
                <div class="column-responsive column-100">
                    <h2>Identity</h2>
                    <table class="condensed">
                <?php endif ?>
                        <tr>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <td><?= h($rat->pedigree_identifier) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($rat->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Pup Name') ?></th>
                            <td><?= h($rat->pup_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Birth Date') ?></th>
                            <td><?= h($rat->birth_date->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::NONE])) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Sex') ?></th>
                            <td><?= h($rat->sex_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Owner User') ?></th>
                            <td><?= $rat->has('owner_user') ? $this->Html->link($rat->owner_user->username, ['controller' => 'Users', 'action' => 'view', $rat->owner_user->id]) : '' ?></td>
                        </tr>
                    </table>
                </div>
                <?php if ($rat->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $rat->picture, ['alt' => $rat->pedigree_identifier]) ?>
                    </div>
                <?php endif ?>
            </div>
            <h2>Origins</h2>
                <table class="condensed">
                    <tr>
                        <th><?= __('Rattery') ?></th>
                        <td><?= $rat->has('rattery') ? $this->Html->link($rat->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $rat->rattery->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Dam') ?></th>
                        <!-- Display field should be better managed (dagger and age in a "full name with age" field) -->
                        <td><?= $rat->has('birth_litter') ? $this->Html->link(
                            $rat->birth_litter->dam[0]->usual_name,
                            ['controller' => 'Rats', 'action' => 'view', $rat->birth_litter->dam[0]->id])
                            : 'Unknown or unregistered' ?><sup><?= $rat->has('birth_litter') ? $rat->birth_litter->dam[0]->is_alive_symbol : '' ?></sup> <?= $rat->has('birth_litter') ? '(' . $rat->birth_litter->dam[0]->age_string . ')' : '' ?>
                            </td>
                    </tr>
                    <tr>
                        <th><?= __('Sire') ?></th>
                        <td><?= $rat->has('birth_litter') ? $this->Html->link(
                            $rat->birth_litter->sire[0]->usual_name,
                            ['controller' => 'Rats', 'action' => 'view', $rat->birth_litter->sire[0]->id])
                            : 'Unknown or unregistered' ?><sup><?= $rat->has('birth_litter') ? $rat->birth_litter->sire[0]->is_alive_symbol : '' ?></sup> <?= $rat->has('birth_litter') ? '(' . $rat->birth_litter->sire[0]->age_string  . ')' : '' ?>
                            </td>
                    </tr>
                    <tr>
                        <th><?= __('Genealogy') ?></th>
                        <td><?= $rat->has('birth_litter') ? $this->Html->link('See birth litter sheet', ['controller' => 'Litters', 'action' => 'view', $rat->birth_litter->id]) . ' (parents and siblings)' : 'Not attached to any litter' ?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><?= $this->Html->link('See interactive family tree', ['controller' => 'Rats', 'action' => 'pedigree', $rat->id]) ?> (all direct ascendants and descendants)</td>
                    </tr>
                </table>

            <h2>Description</h2>
                <table class="condensed">
                    <tr>
                        <th><?= __('Color') ?></th>
                        <td><?= $rat->has('color') ? $this->Html->link($rat->color->name, ['controller' => 'Colors', 'action' => 'view', $rat->color->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Eyecolor') ?></th>
                        <td><?= $rat->has('eyecolor') ? $this->Html->link($rat->eyecolor->name, ['controller' => 'Eyecolors', 'action' => 'view', $rat->eyecolor->id]) : '' ?></td>
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
                        <th><?= __('Singularities') ?></th>
                        <td><?= $rat->singularity_string ?></td>
                    </tr>
                </table>

            <h2>Health</h2>
            <table class="condensed">
                <tr>
                    <th><?= __('Is Alive') ?></th>
                    <td><?= $rat->is_alive ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= $rat->is_alive ? __('Age') : __('Age at death'); ?></th>
                    <td><?= h($rat->age_string) ?></td>
                </tr>
                <?php if (!$rat->is_alive) : ?>
                <tr>
                    <th><?= __('Death Date') ?></th>
                    <td><?= $rat->has('death_date') ? h($rat->death_date->i18nFormat('dd/MM/yyyy')) : 'Unknown' ?></td>
                    </tr>
                <tr>
                <th><?= __('Death Primary Cause') ?></th>
                    <td><?= $rat->has('death_primary_cause') ? $this->Html->link($rat->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $rat->death_primary_cause->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Secondary Cause') ?></th>
                    <td><?= $rat->has('death_secondary_cause') ? $this->Html->link($rat->death_secondary_cause->name, ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $rat->death_secondary_cause->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Euthanized') ?></th>
                    <td><?= $rat->death_euthanized ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Diagnosed') ?></th>
                    <td><?= $rat->death_diagnosed ? __('Yes') : __('No'); ?></td>
                    </tr>
                <tr>
                    <th><?= __('Death Necropsied') ?></th>
                    <td><?= $rat->death_necropsied ? __('Yes') : __('No'); ?></td>
                </tr>
                <?php endif; ?>
            </table>

            <h2>Comments</h2>
            <div class="text">
                <blockquote>
                    <?= $this->Text->autoParagraph(h($rat->comments)); ?>
                </blockquote>
            </div>
            <div class="spacer"> </div>
            <?php if (!empty($rat->bred_litters)) : ?>
                <h2><?= __('Bred Litters') ?></h2>
                <div class="related">
                    <?php foreach ($rat->bred_litters as $litter) : ?>
                        <details>
                            <summary>
                                <?php if($rat->sex === 'M') { echo $litter->name_from_sire ; } else { echo $litter->name_from_dam ; } ?>
                            </summary>
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

            <div class="spacer"> </div>
            <h2 class="staff"><?= __('Private information') ?></h2>
            <div class="related">
                <details>
                    <summary class="staff">
                        <?= __('Conversations') ?>
                    </summary>
                    <?php if (!empty($rat->conversations)) : ?>
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
                            <?php foreach ($rat->conversations as $conversations) : ?>
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
                </details>
                <details>
                    <summary class="staff">
                        <?= __('Snapshots') ?>
                    </summary>
                    <?php if (!empty($rat->rat_snapshots)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Created') ?></th>
                                <!-- <th><?= __('Data') ?></th> -->
                                <th><?= __('State') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($rat->rat_snapshots as $ratSnapshots) : ?>
                            <tr>
                                <td><?= h($ratSnapshots->created) ?></td>
                                <!-- <td><?= h($ratSnapshots->data) ?></td> -->
                                <td><?= h($ratSnapshots->state->symbol) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'RatSnapshots', 'action' => 'view', $ratSnapshots->id]) ?>
                                    <?= $this->Html->link(__('Restore'), ['controller' => 'Rats', 'action' => 'restore', $rat->id, $ratSnapshots->id]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php endif; ?>
                </details>
            </div>
            <div class="signature">
                &mdash; Created on <?= $rat->created->i18nFormat('dd/MM/yyyy') ?> by <?= $rat->creator_user->username ?>. <?= ($rat->modified != $rat->created) ? 'Last modified on ' . $rat->modified->i18nFormat('dd/MM/yyyy') .'.' : '' ?>
            </div>
        </div>
    </div>
</div>
