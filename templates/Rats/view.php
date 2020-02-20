<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rat'), ['action' => 'edit', $rat->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rat'), ['action' => 'delete', $rat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rat->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rat'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="rats view content">
            <h3><?= h($rat->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name Owner') ?></th>
                    <td><?= h($rat->name_owner) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name Pup') ?></th>
                    <td><?= h($rat->name_pup) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sex') ?></th>
                    <td><?= h($rat->sex) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pedigree Identifier') ?></th>
                    <td><?= h($rat->pedigree_identifier) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Causes Primary') ?></th>
                    <td><?= $rat->has('death_causes_primary') ? $this->Html->link($rat->death_causes_primary->id, ['controller' => 'DeathCausesPrimary', 'action' => 'view', $rat->death_causes_primary->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Causes Secondary') ?></th>
                    <td><?= $rat->has('death_causes_secondary') ? $this->Html->link($rat->death_causes_secondary->id, ['controller' => 'DeathCausesSecondary', 'action' => 'view', $rat->death_causes_secondary->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($rat->picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture Thumbnail') ?></th>
                    <td><?= h($rat->picture_thumbnail) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $rat->has('rattery') ? $this->Html->link($rat->rattery->name, ['controller' => 'Ratteries', 'action' => 'view', $rat->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat') ?></th>
                    <td><?= $rat->has('rat') ? $this->Html->link($rat->rat->id, ['controller' => 'Rats', 'action' => 'view', $rat->rat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $rat->has('litter') ? $this->Html->link($rat->litter->id, ['controller' => 'Litters', 'action' => 'view', $rat->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= $rat->has('color') ? $this->Html->link($rat->color->id, ['controller' => 'Colors', 'action' => 'view', $rat->color->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Earset') ?></th>
                    <td><?= $rat->has('earset') ? $this->Html->link($rat->earset->id, ['controller' => 'Earsets', 'action' => 'view', $rat->earset->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Eyecolor') ?></th>
                    <td><?= $rat->has('eyecolor') ? $this->Html->link($rat->eyecolor->id, ['controller' => 'Eyecolors', 'action' => 'view', $rat->eyecolor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Dilution') ?></th>
                    <td><?= $rat->has('dilution') ? $this->Html->link($rat->dilution->id, ['controller' => 'Dilutions', 'action' => 'view', $rat->dilution->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Coat') ?></th>
                    <td><?= $rat->has('coat') ? $this->Html->link($rat->coat->id, ['controller' => 'Coats', 'action' => 'view', $rat->coat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Marking') ?></th>
                    <td><?= $rat->has('marking') ? $this->Html->link($rat->marking->id, ['controller' => 'Markings', 'action' => 'view', $rat->marking->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $rat->has('user') ? $this->Html->link($rat->user->id, ['controller' => 'Users', 'action' => 'view', $rat->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rat->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery Mother Id') ?></th>
                    <td><?= $this->Number->format($rat->rattery_mother_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mother Id') ?></th>
                    <td><?= $this->Number->format($rat->mother_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Owner Id') ?></th>
                    <td><?= $this->Number->format($rat->owner_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Birth') ?></th>
                    <td><?= h($rat->date_birth) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Death') ?></th>
                    <td><?= h($rat->date_death) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($rat->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($rat->modified) ?></td>
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
                <tr>
                    <th><?= __('Validated') ?></th>
                    <td><?= $rat->validated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($rat->comments)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Singularities') ?></h4>
                <?php if (!empty($rat->singularities)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name Fr') ?></th>
                            <th><?= __('Name En') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rat->singularities as $singularities) : ?>
                        <tr>
                            <td><?= h($singularities->id) ?></td>
                            <td><?= h($singularities->name_fr) ?></td>
                            <td><?= h($singularities->name_en) ?></td>
                            <td><?= h($singularities->picture) ?></td>
                            <td><?= h($singularities->created) ?></td>
                            <td><?= h($singularities->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Singularities', 'action' => 'view', $singularities->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Singularities', 'action' => 'edit', $singularities->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Singularities', 'action' => 'delete', $singularities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $singularities->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Backoffice Rat Entries') ?></h4>
                <?php if (!empty($rat->backoffice_rat_entries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Rat Id') ?></th>
                            <th><?= __('Rat Name Owner') ?></th>
                            <th><?= __('Rat Name Pup') ?></th>
                            <th><?= __('Rat Sex') ?></th>
                            <th><?= __('Rat Pedigree Identifier') ?></th>
                            <th><?= __('Rat Date Birth') ?></th>
                            <th><?= __('Rat Date Death') ?></th>
                            <th><?= __('Death Cause Primary Id') ?></th>
                            <th><?= __('Death Cause Secondary Id') ?></th>
                            <th><?= __('Rat Death Euthanized') ?></th>
                            <th><?= __('Rat Death Diagnosed') ?></th>
                            <th><?= __('Rat Death Necropsied') ?></th>
                            <th><?= __('Rat Picture') ?></th>
                            <th><?= __('Rat Picture Thumbnail') ?></th>
                            <th><?= __('Rat Comments') ?></th>
                            <th><?= __('Rat Validated') ?></th>
                            <th><?= __('Rattery Mother Id') ?></th>
                            <th><?= __('Rattery Father Id') ?></th>
                            <th><?= __('Rat Mother Id') ?></th>
                            <th><?= __('Rat Father Id') ?></th>
                            <th><?= __('User Owner Id') ?></th>
                            <th><?= __('Color Id') ?></th>
                            <th><?= __('Earset Id') ?></th>
                            <th><?= __('Eyecolor Id') ?></th>
                            <th><?= __('Dilution Id') ?></th>
                            <th><?= __('Coat Id') ?></th>
                            <th><?= __('Marking Id') ?></th>
                            <th><?= __('Singularity Id List') ?></th>
                            <th><?= __('User Creator Id') ?></th>
                            <th><?= __('Rat Date Create') ?></th>
                            <th><?= __('Rat Date Last Update') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rat->backoffice_rat_entries as $backofficeRatEntries) : ?>
                        <tr>
                            <td><?= h($backofficeRatEntries->id) ?></td>
                            <td><?= h($backofficeRatEntries->status) ?></td>
                            <td><?= h($backofficeRatEntries->rat_id) ?></td>
                            <td><?= h($backofficeRatEntries->rat_name_owner) ?></td>
                            <td><?= h($backofficeRatEntries->rat_name_pup) ?></td>
                            <td><?= h($backofficeRatEntries->rat_sex) ?></td>
                            <td><?= h($backofficeRatEntries->rat_pedigree_identifier) ?></td>
                            <td><?= h($backofficeRatEntries->rat_date_birth) ?></td>
                            <td><?= h($backofficeRatEntries->rat_date_death) ?></td>
                            <td><?= h($backofficeRatEntries->death_cause_primary_id) ?></td>
                            <td><?= h($backofficeRatEntries->death_cause_secondary_id) ?></td>
                            <td><?= h($backofficeRatEntries->rat_death_euthanized) ?></td>
                            <td><?= h($backofficeRatEntries->rat_death_diagnosed) ?></td>
                            <td><?= h($backofficeRatEntries->rat_death_necropsied) ?></td>
                            <td><?= h($backofficeRatEntries->rat_picture) ?></td>
                            <td><?= h($backofficeRatEntries->rat_picture_thumbnail) ?></td>
                            <td><?= h($backofficeRatEntries->rat_comments) ?></td>
                            <td><?= h($backofficeRatEntries->rat_validated) ?></td>
                            <td><?= h($backofficeRatEntries->rattery_mother_id) ?></td>
                            <td><?= h($backofficeRatEntries->rattery_father_id) ?></td>
                            <td><?= h($backofficeRatEntries->rat_mother_id) ?></td>
                            <td><?= h($backofficeRatEntries->rat_father_id) ?></td>
                            <td><?= h($backofficeRatEntries->user_owner_id) ?></td>
                            <td><?= h($backofficeRatEntries->color_id) ?></td>
                            <td><?= h($backofficeRatEntries->earset_id) ?></td>
                            <td><?= h($backofficeRatEntries->eyecolor_id) ?></td>
                            <td><?= h($backofficeRatEntries->dilution_id) ?></td>
                            <td><?= h($backofficeRatEntries->coat_id) ?></td>
                            <td><?= h($backofficeRatEntries->marking_id) ?></td>
                            <td><?= h($backofficeRatEntries->singularity_id_list) ?></td>
                            <td><?= h($backofficeRatEntries->user_creator_id) ?></td>
                            <td><?= h($backofficeRatEntries->rat_date_create) ?></td>
                            <td><?= h($backofficeRatEntries->rat_date_last_update) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'BackofficeRatEntries', 'action' => 'view', $backofficeRatEntries->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'BackofficeRatEntries', 'action' => 'edit', $backofficeRatEntries->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'BackofficeRatEntries', 'action' => 'delete', $backofficeRatEntries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatEntries->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
