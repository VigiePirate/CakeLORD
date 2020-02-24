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
                    <th><?= __('Name') ?></th>
                    <td><?= h($rat->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pup Name') ?></th>
                    <td><?= h($rat->pup_name) ?></td>
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
                    <th><?= __('State') ?></th>
                    <td><?= $rat->has('state') ? $this->Html->link($rat->state->name, ['controller' => 'States', 'action' => 'view', $rat->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $rat->has('rattery') ? $this->Html->link($rat->rattery->name, ['controller' => 'Ratteries', 'action' => 'view', $rat->rattery->id]) : '' ?></td>
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
                    <th><?= __('Owner User Id') ?></th>
                    <td><?= $this->Number->format($rat->owner_user_id) ?></td>
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
                    <th><?= __('Is Alive') ?></th>
                    <td><?= $rat->is_alive ? __('Yes') : __('No'); ?></td>
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
                            <th><?= __('Name') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rat->singularities as $singularities) : ?>
                        <tr>
                            <td><?= h($singularities->id) ?></td>
                            <td><?= h($singularities->name) ?></td>
                            <td><?= h($singularities->picture) ?></td>
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
                <h4><?= __('Related Conversations') ?></h4>
                <?php if (!empty($rat->conversations)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Rat Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rat->conversations as $conversations) : ?>
                        <tr>
                            <td><?= h($conversations->id) ?></td>
                            <td><?= h($conversations->rattery_id) ?></td>
                            <td><?= h($conversations->litter_id) ?></td>
                            <td><?= h($conversations->rat_id) ?></td>
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
            <div class="related">
                <h4><?= __('Related Rat Snapshots') ?></h4>
                <?php if (!empty($rat->rat_snapshots)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Rat Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rat->rat_snapshots as $ratSnapshots) : ?>
                        <tr>
                            <td><?= h($ratSnapshots->id) ?></td>
                            <td><?= h($ratSnapshots->data) ?></td>
                            <td><?= h($ratSnapshots->created) ?></td>
                            <td><?= h($ratSnapshots->rat_id) ?></td>
                            <td><?= h($ratSnapshots->state_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RatSnapshots', 'action' => 'view', $ratSnapshots->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RatSnapshots', 'action' => 'edit', $ratSnapshots->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RatSnapshots', 'action' => 'delete', $ratSnapshots->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratSnapshots->id)]) ?>
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
