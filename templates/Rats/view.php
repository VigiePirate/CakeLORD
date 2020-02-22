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
                    <th><?= __('Death Primary Cause') ?></th>
                    <td><?= $rat->has('death_primary_cause') ? $this->Html->link($rat->death_primary_cause->id, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $rat->death_primary_cause->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Secondary Cause') ?></th>
                    <td><?= $rat->has('death_secondary_cause') ? $this->Html->link($rat->death_secondary_cause->id, ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $rat->death_secondary_cause->id]) : '' ?></td>
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
                    <th><?= __('State') ?></th>
                    <td><?= $rat->has('state') ? $this->Html->link($rat->state->name, ['controller' => 'States', 'action' => 'view', $rat->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rat->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mother Rattery Id') ?></th>
                    <td><?= $this->Number->format($rat->mother_rattery_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Father Rattery Id') ?></th>
                    <td><?= $this->Number->format($rat->father_rattery_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mother Rat Id') ?></th>
                    <td><?= $this->Number->format($rat->mother_rat_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Father Rat Id') ?></th>
                    <td><?= $this->Number->format($rat->father_rat_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Owner User Id') ?></th>
                    <td><?= $this->Number->format($rat->owner_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Creator User Id') ?></th>
                    <td><?= $this->Number->format($rat->creator_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth Date') ?></th>
                    <td><?= h($rat->birth_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Date') ?></th>
                    <td><?= h($rat->death_date) ?></td>
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
                        <?php foreach ($rat->backoffice_rat_entries as $backofficeRatEntries) : ?>
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
        </div>
    </div>
</div>
