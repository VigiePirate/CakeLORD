<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dilution $dilution
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Dilution'), ['action' => 'edit', $dilution->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dilution'), ['action' => 'delete', $dilution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dilution->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dilutions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dilution'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dilutions view content">
            <h3><?= h($dilution->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name Fr') ?></th>
                    <td><?= h($dilution->name_fr) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name En') ?></th>
                    <td><?= h($dilution->name_en) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($dilution->picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($dilution->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Backoffice Rat Entries') ?></h4>
                <?php if (!empty($dilution->backoffice_rat_entries)) : ?>
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
                        <?php foreach ($dilution->backoffice_rat_entries as $backofficeRatEntries) : ?>
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
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($dilution->rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name Owner') ?></th>
                            <th><?= __('Name Pup') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Date Birth') ?></th>
                            <th><?= __('Date Death') ?></th>
                            <th><?= __('Death Cause Primary Id') ?></th>
                            <th><?= __('Death Cause Secondary Id') ?></th>
                            <th><?= __('Death Euthanized') ?></th>
                            <th><?= __('Death Diagnosed') ?></th>
                            <th><?= __('Death Necropsied') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Picture Thumbnail') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Validated') ?></th>
                            <th><?= __('Rattery Mother Id') ?></th>
                            <th><?= __('Rattery Father Id') ?></th>
                            <th><?= __('Mother Id') ?></th>
                            <th><?= __('Father Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Owner Id') ?></th>
                            <th><?= __('Color Id') ?></th>
                            <th><?= __('Earset Id') ?></th>
                            <th><?= __('Eyecolor Id') ?></th>
                            <th><?= __('Dilution Id') ?></th>
                            <th><?= __('Coat Id') ?></th>
                            <th><?= __('Marking Id') ?></th>
                            <th><?= __('User Creator Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($dilution->rats as $rats) : ?>
                        <tr>
                            <td><?= h($rats->id) ?></td>
                            <td><?= h($rats->name_owner) ?></td>
                            <td><?= h($rats->name_pup) ?></td>
                            <td><?= h($rats->sex) ?></td>
                            <td><?= h($rats->pedigree_identifier) ?></td>
                            <td><?= h($rats->date_birth) ?></td>
                            <td><?= h($rats->date_death) ?></td>
                            <td><?= h($rats->death_cause_primary_id) ?></td>
                            <td><?= h($rats->death_cause_secondary_id) ?></td>
                            <td><?= h($rats->death_euthanized) ?></td>
                            <td><?= h($rats->death_diagnosed) ?></td>
                            <td><?= h($rats->death_necropsied) ?></td>
                            <td><?= h($rats->picture) ?></td>
                            <td><?= h($rats->picture_thumbnail) ?></td>
                            <td><?= h($rats->comments) ?></td>
                            <td><?= h($rats->validated) ?></td>
                            <td><?= h($rats->rattery_mother_id) ?></td>
                            <td><?= h($rats->rattery_father_id) ?></td>
                            <td><?= h($rats->mother_id) ?></td>
                            <td><?= h($rats->father_id) ?></td>
                            <td><?= h($rats->litter_id) ?></td>
                            <td><?= h($rats->owner_id) ?></td>
                            <td><?= h($rats->color_id) ?></td>
                            <td><?= h($rats->earset_id) ?></td>
                            <td><?= h($rats->eyecolor_id) ?></td>
                            <td><?= h($rats->dilution_id) ?></td>
                            <td><?= h($rats->coat_id) ?></td>
                            <td><?= h($rats->marking_id) ?></td>
                            <td><?= h($rats->user_creator_id) ?></td>
                            <td><?= h($rats->created) ?></td>
                            <td><?= h($rats->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $rats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $rats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $rats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rats->id)]) ?>
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
