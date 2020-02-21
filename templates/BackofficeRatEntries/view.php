<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatEntry $backofficeRatEntry
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Backoffice Rat Entry'), ['action' => 'edit', $backofficeRatEntry->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Backoffice Rat Entry'), ['action' => 'delete', $backofficeRatEntry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatEntry->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Backoffice Rat Entries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Backoffice Rat Entry'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="backofficeRatEntries view content">
            <h3><?= h($backofficeRatEntry->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rat') ?></th>
                    <td><?= $backofficeRatEntry->has('rat') ? $this->Html->link($backofficeRatEntry->rat->id, ['controller' => 'Rats', 'action' => 'view', $backofficeRatEntry->rat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Name Owner') ?></th>
                    <td><?= h($backofficeRatEntry->rat_name_owner) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Name Pup') ?></th>
                    <td><?= h($backofficeRatEntry->rat_name_pup) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Sex') ?></th>
                    <td><?= h($backofficeRatEntry->rat_sex) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Pedigree Identifier') ?></th>
                    <td><?= h($backofficeRatEntry->rat_pedigree_identifier) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Causes Primary') ?></th>
                    <td><?= $backofficeRatEntry->has('death_causes_primary') ? $this->Html->link($backofficeRatEntry->death_causes_primary->id, ['controller' => 'DeathCausesPrimary', 'action' => 'view', $backofficeRatEntry->death_causes_primary->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Causes Secondary') ?></th>
                    <td><?= $backofficeRatEntry->has('death_causes_secondary') ? $this->Html->link($backofficeRatEntry->death_causes_secondary->id, ['controller' => 'DeathCausesSecondary', 'action' => 'view', $backofficeRatEntry->death_causes_secondary->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Picture') ?></th>
                    <td><?= h($backofficeRatEntry->rat_picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Picture Thumbnail') ?></th>
                    <td><?= h($backofficeRatEntry->rat_picture_thumbnail) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $backofficeRatEntry->has('rattery') ? $this->Html->link($backofficeRatEntry->rattery->name, ['controller' => 'Ratteries', 'action' => 'view', $backofficeRatEntry->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Backoffice Rat Entry') ?></th>
                    <td><?= $backofficeRatEntry->has('backoffice_rat_entry') ? $this->Html->link($backofficeRatEntry->backoffice_rat_entry->id, ['controller' => 'BackofficeRatEntries', 'action' => 'view', $backofficeRatEntry->backoffice_rat_entry->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= $backofficeRatEntry->has('color') ? $this->Html->link($backofficeRatEntry->color->id, ['controller' => 'Colors', 'action' => 'view', $backofficeRatEntry->color->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Earset') ?></th>
                    <td><?= $backofficeRatEntry->has('earset') ? $this->Html->link($backofficeRatEntry->earset->id, ['controller' => 'Earsets', 'action' => 'view', $backofficeRatEntry->earset->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Eyecolor') ?></th>
                    <td><?= $backofficeRatEntry->has('eyecolor') ? $this->Html->link($backofficeRatEntry->eyecolor->id, ['controller' => 'Eyecolors', 'action' => 'view', $backofficeRatEntry->eyecolor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Dilution') ?></th>
                    <td><?= $backofficeRatEntry->has('dilution') ? $this->Html->link($backofficeRatEntry->dilution->id, ['controller' => 'Dilutions', 'action' => 'view', $backofficeRatEntry->dilution->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Coat') ?></th>
                    <td><?= $backofficeRatEntry->has('coat') ? $this->Html->link($backofficeRatEntry->coat->id, ['controller' => 'Coats', 'action' => 'view', $backofficeRatEntry->coat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Marking') ?></th>
                    <td><?= $backofficeRatEntry->has('marking') ? $this->Html->link($backofficeRatEntry->marking->id, ['controller' => 'Markings', 'action' => 'view', $backofficeRatEntry->marking->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Singularity Id List') ?></th>
                    <td><?= h($backofficeRatEntry->singularity_id_list) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $backofficeRatEntry->has('user') ? $this->Html->link($backofficeRatEntry->user->id, ['controller' => 'Users', 'action' => 'view', $backofficeRatEntry->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Validated') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->rat_validated) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery Mother Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->rattery_mother_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Mother Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->rat_mother_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Owner Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->user_owner_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Date Birth') ?></th>
                    <td><?= h($backofficeRatEntry->rat_date_birth) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Date Death') ?></th>
                    <td><?= h($backofficeRatEntry->rat_date_death) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Date Create') ?></th>
                    <td><?= h($backofficeRatEntry->rat_date_create) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Date Last Update') ?></th>
                    <td><?= h($backofficeRatEntry->rat_date_last_update) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Death Euthanized') ?></th>
                    <td><?= $backofficeRatEntry->rat_death_euthanized ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Death Diagnosed') ?></th>
                    <td><?= $backofficeRatEntry->rat_death_diagnosed ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Rat Death Necropsied') ?></th>
                    <td><?= $backofficeRatEntry->rat_death_necropsied ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Rat Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($backofficeRatEntry->rat_comments)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Backoffice Rat Messages') ?></h4>
                <?php if (!empty($backofficeRatEntry->backoffice_rat_messages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Backoffice Rat Entry Id') ?></th>
                            <th><?= __('Staff Id') ?></th>
                            <th><?= __('Staff Comments') ?></th>
                            <th><?= __('Owner Comments') ?></th>
                            <th><?= __('Date Staff Comments') ?></th>
                            <th><?= __('Date Owner Comments') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($backofficeRatEntry->backoffice_rat_messages as $backofficeRatMessages) : ?>
                        <tr>
                            <td><?= h($backofficeRatMessages->id) ?></td>
                            <td><?= h($backofficeRatMessages->backoffice_rat_entry_id) ?></td>
                            <td><?= h($backofficeRatMessages->staff_id) ?></td>
                            <td><?= h($backofficeRatMessages->staff_comments) ?></td>
                            <td><?= h($backofficeRatMessages->owner_comments) ?></td>
                            <td><?= h($backofficeRatMessages->date_staff_comments) ?></td>
                            <td><?= h($backofficeRatMessages->date_owner_comments) ?></td>
                            <td><?= h($backofficeRatMessages->created) ?></td>
                            <td><?= h($backofficeRatMessages->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'BackofficeRatMessages', 'action' => 'view', $backofficeRatMessages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'BackofficeRatMessages', 'action' => 'edit', $backofficeRatMessages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'BackofficeRatMessages', 'action' => 'delete', $backofficeRatMessages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatMessages->id)]) ?>
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
