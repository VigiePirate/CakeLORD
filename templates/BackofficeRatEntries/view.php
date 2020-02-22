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
                    <th><?= __('Owner Name') ?></th>
                    <td><?= h($backofficeRatEntry->owner_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pup Name') ?></th>
                    <td><?= h($backofficeRatEntry->pup_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sex') ?></th>
                    <td><?= h($backofficeRatEntry->sex) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pedigree Identifier') ?></th>
                    <td><?= h($backofficeRatEntry->pedigree_identifier) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($backofficeRatEntry->picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture Thumbnail') ?></th>
                    <td><?= h($backofficeRatEntry->picture_thumbnail) ?></td>
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
                    <th><?= __('State') ?></th>
                    <td><?= $backofficeRatEntry->has('state') ? $this->Html->link($backofficeRatEntry->state->name, ['controller' => 'States', 'action' => 'view', $backofficeRatEntry->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Primary Death Cause Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->primary_death_cause_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Secondary Death Cause Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->secondary_death_cause_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mother Rattery Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->mother_rattery_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Father Rattery Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->father_rattery_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mother Rat Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->mother_rat_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Father Rat Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->father_rat_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Owner User Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->owner_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Creator User Id') ?></th>
                    <td><?= $this->Number->format($backofficeRatEntry->creator_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth Date') ?></th>
                    <td><?= h($backofficeRatEntry->birth_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Date') ?></th>
                    <td><?= h($backofficeRatEntry->death_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($backofficeRatEntry->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($backofficeRatEntry->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Euthanized') ?></th>
                    <td><?= $backofficeRatEntry->death_euthanized ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Diagnosed') ?></th>
                    <td><?= $backofficeRatEntry->death_diagnosed ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Necropsied') ?></th>
                    <td><?= $backofficeRatEntry->death_necropsied ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Validated') ?></th>
                    <td><?= $backofficeRatEntry->validated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($backofficeRatEntry->comments)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Singularities') ?></h4>
                <?php if (!empty($backofficeRatEntry->singularities)) : ?>
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
                        <?php foreach ($backofficeRatEntry->singularities as $singularities) : ?>
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
