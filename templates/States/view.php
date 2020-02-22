<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit State'), ['action' => 'edit', $state->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete State'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New State'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="states view content">
            <h3><?= h($state->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($state->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= h($state->color) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($state->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Backoffice Rat Entries') ?></h4>
                <?php if (!empty($state->backoffice_rat_entries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Rat Id') ?></th>
                            <th><?= __('Owner Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Death Date') ?></th>
                            <th><?= __('Primary Death Cause Id') ?></th>
                            <th><?= __('Secondary Death Cause Id') ?></th>
                            <th><?= __('Death Euthanized') ?></th>
                            <th><?= __('Death Diagnosed') ?></th>
                            <th><?= __('Death Necropsied') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Picture Thumbnail') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Validated') ?></th>
                            <th><?= __('Mother Rattery Id') ?></th>
                            <th><?= __('Father Rattery Id') ?></th>
                            <th><?= __('Mother Rat Id') ?></th>
                            <th><?= __('Father Rat Id') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Color Id') ?></th>
                            <th><?= __('Earset Id') ?></th>
                            <th><?= __('Eyecolor Id') ?></th>
                            <th><?= __('Dilution Id') ?></th>
                            <th><?= __('Coat Id') ?></th>
                            <th><?= __('Marking Id') ?></th>
                            <th><?= __('Creator User Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->backoffice_rat_entries as $backofficeRatEntries) : ?>
                        <tr>
                            <td><?= h($backofficeRatEntries->id) ?></td>
                            <td><?= h($backofficeRatEntries->rat_id) ?></td>
                            <td><?= h($backofficeRatEntries->owner_name) ?></td>
                            <td><?= h($backofficeRatEntries->pup_name) ?></td>
                            <td><?= h($backofficeRatEntries->sex) ?></td>
                            <td><?= h($backofficeRatEntries->pedigree_identifier) ?></td>
                            <td><?= h($backofficeRatEntries->birth_date) ?></td>
                            <td><?= h($backofficeRatEntries->death_date) ?></td>
                            <td><?= h($backofficeRatEntries->primary_death_cause_id) ?></td>
                            <td><?= h($backofficeRatEntries->secondary_death_cause_id) ?></td>
                            <td><?= h($backofficeRatEntries->death_euthanized) ?></td>
                            <td><?= h($backofficeRatEntries->death_diagnosed) ?></td>
                            <td><?= h($backofficeRatEntries->death_necropsied) ?></td>
                            <td><?= h($backofficeRatEntries->picture) ?></td>
                            <td><?= h($backofficeRatEntries->picture_thumbnail) ?></td>
                            <td><?= h($backofficeRatEntries->comments) ?></td>
                            <td><?= h($backofficeRatEntries->validated) ?></td>
                            <td><?= h($backofficeRatEntries->mother_rattery_id) ?></td>
                            <td><?= h($backofficeRatEntries->father_rattery_id) ?></td>
                            <td><?= h($backofficeRatEntries->mother_rat_id) ?></td>
                            <td><?= h($backofficeRatEntries->father_rat_id) ?></td>
                            <td><?= h($backofficeRatEntries->owner_user_id) ?></td>
                            <td><?= h($backofficeRatEntries->color_id) ?></td>
                            <td><?= h($backofficeRatEntries->earset_id) ?></td>
                            <td><?= h($backofficeRatEntries->eyecolor_id) ?></td>
                            <td><?= h($backofficeRatEntries->dilution_id) ?></td>
                            <td><?= h($backofficeRatEntries->coat_id) ?></td>
                            <td><?= h($backofficeRatEntries->marking_id) ?></td>
                            <td><?= h($backofficeRatEntries->creator_user_id) ?></td>
                            <td><?= h($backofficeRatEntries->created) ?></td>
                            <td><?= h($backofficeRatEntries->modified) ?></td>
                            <td><?= h($backofficeRatEntries->state_id) ?></td>
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
                <?php if (!empty($state->rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name Owner') ?></th>
                            <th><?= __('Name Pup') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Death Date') ?></th>
                            <th><?= __('Death Primary Cause Id') ?></th>
                            <th><?= __('Death Secondary Cause Id') ?></th>
                            <th><?= __('Death Euthanized') ?></th>
                            <th><?= __('Death Diagnosed') ?></th>
                            <th><?= __('Death Necropsied') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Picture Thumbnail') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Validated') ?></th>
                            <th><?= __('Mother Rattery Id') ?></th>
                            <th><?= __('Father Rattery Id') ?></th>
                            <th><?= __('Mother Rat Id') ?></th>
                            <th><?= __('Father Rat Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Color Id') ?></th>
                            <th><?= __('Earset Id') ?></th>
                            <th><?= __('Eyecolor Id') ?></th>
                            <th><?= __('Dilution Id') ?></th>
                            <th><?= __('Coat Id') ?></th>
                            <th><?= __('Marking Id') ?></th>
                            <th><?= __('Creator User Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->rats as $rats) : ?>
                        <tr>
                            <td><?= h($rats->id) ?></td>
                            <td><?= h($rats->name_owner) ?></td>
                            <td><?= h($rats->name_pup) ?></td>
                            <td><?= h($rats->sex) ?></td>
                            <td><?= h($rats->pedigree_identifier) ?></td>
                            <td><?= h($rats->birth_date) ?></td>
                            <td><?= h($rats->death_date) ?></td>
                            <td><?= h($rats->death_primary_cause_id) ?></td>
                            <td><?= h($rats->death_secondary_cause_id) ?></td>
                            <td><?= h($rats->death_euthanized) ?></td>
                            <td><?= h($rats->death_diagnosed) ?></td>
                            <td><?= h($rats->death_necropsied) ?></td>
                            <td><?= h($rats->picture) ?></td>
                            <td><?= h($rats->picture_thumbnail) ?></td>
                            <td><?= h($rats->comments) ?></td>
                            <td><?= h($rats->validated) ?></td>
                            <td><?= h($rats->mother_rattery_id) ?></td>
                            <td><?= h($rats->father_rattery_id) ?></td>
                            <td><?= h($rats->mother_rat_id) ?></td>
                            <td><?= h($rats->father_rat_id) ?></td>
                            <td><?= h($rats->litter_id) ?></td>
                            <td><?= h($rats->owner_user_id) ?></td>
                            <td><?= h($rats->color_id) ?></td>
                            <td><?= h($rats->earset_id) ?></td>
                            <td><?= h($rats->eyecolor_id) ?></td>
                            <td><?= h($rats->dilution_id) ?></td>
                            <td><?= h($rats->coat_id) ?></td>
                            <td><?= h($rats->marking_id) ?></td>
                            <td><?= h($rats->creator_user_id) ?></td>
                            <td><?= h($rats->created) ?></td>
                            <td><?= h($rats->modified) ?></td>
                            <td><?= h($rats->state_id) ?></td>
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
