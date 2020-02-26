<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rattery $rattery
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rattery'), ['action' => 'edit', $rattery->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rattery'), ['action' => 'delete', $rattery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rattery->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ratteries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rattery'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratteries view content">
            <h3><?= h($rattery->prefix) ?></h3>
            <table>
                <tr>
                    <th><?= __('Prefix') ?></th>
                    <td><?= h($rattery->prefix) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($rattery->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->username, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth Year') ?></th>
                    <td><?= h($rattery->birth_year) ?></td>
                </tr>
                <tr>
                    <th><?= __('District') ?></th>
                    <td><?= h($rattery->district) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zip Code') ?></th>
                    <td><?= h($rattery->zip_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Website') ?></th>
                    <td><?= h($rattery->website) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($rattery->picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $rattery->has('state') ? $this->Html->link($rattery->state->name, ['controller' => 'States', 'action' => 'view', $rattery->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rattery->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Countries Id') ?></th>
                    <td><?= $this->Number->format($rattery->countries_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($rattery->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($rattery->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Alive') ?></th>
                    <td><?= $rattery->is_alive ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($rattery->comments)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Conversations') ?></h4>
                <?php if (!empty($rattery->conversations)) : ?>
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
                        <?php foreach ($rattery->conversations as $conversations) : ?>
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
            </div>
            <div class="related">
                <h4><?= __('Related Litters') ?></h4>
                <?php if (!empty($rattery->litters)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Mother Rat Id') ?></th>
                            <th><?= __('Father Rat Id') ?></th>
                            <th><?= __('Mating Date') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Pups Number') ?></th>
                            <th><?= __('Pups Number Stillborn') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Creator User Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rattery->litters as $litters) : ?>
                        <tr>
                            <td><?= h($litters->id) ?></td>
                            <td><?= h($litters->rattery_id) ?></td>
                            <td><?= h($litters->mother_rat_id) ?></td>
                            <td><?= h($litters->father_rat_id) ?></td>
                            <td><?= h($litters->mating_date) ?></td>
                            <td><?= h($litters->birth_date) ?></td>
                            <td><?= h($litters->pups_number) ?></td>
                            <td><?= h($litters->pups_number_stillborn) ?></td>
                            <td><?= h($litters->comments) ?></td>
                            <td><?= h($litters->creator_user_id) ?></td>
                            <td><?= h($litters->state_id) ?></td>
                            <td><?= h($litters->created) ?></td>
                            <td><?= h($litters->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Litters', 'action' => 'view', $litters->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Litters', 'action' => 'edit', $litters->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Litters', 'action' => 'delete', $litters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litters->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($rattery->rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Mother Rat Id') ?></th>
                            <th><?= __('Father Rat Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Mother Rattery Id') ?></th>
                            <th><?= __('Father Rattery Id') ?></th>
                            <th><?= __('Color Id') ?></th>
                            <th><?= __('Eyecolor Id') ?></th>
                            <th><?= __('Dilution Id') ?></th>
                            <th><?= __('Marking Id') ?></th>
                            <th><?= __('Earset Id') ?></th>
                            <th><?= __('Coat Id') ?></th>
                            <th><?= __('Is Alive') ?></th>
                            <th><?= __('Death Date') ?></th>
                            <th><?= __('Death Primary Cause Id') ?></th>
                            <th><?= __('Death Secondary Cause Id') ?></th>
                            <th><?= __('Death Euthanized') ?></th>
                            <th><?= __('Death Diagnosed') ?></th>
                            <th><?= __('Death Necropsied') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Picture Thumbnail') ?></th>
                            <th><?= __('Creator User Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rattery->rats as $rats) : ?>
                        <tr>
                            <td><?= h($rats->id) ?></td>
                            <td><?= h($rats->pedigree_identifier) ?></td>
                            <td><?= h($rats->owner_user_id) ?></td>
                            <td><?= h($rats->name) ?></td>
                            <td><?= h($rats->pup_name) ?></td>
                            <td><?= h($rats->sex) ?></td>
                            <td><?= h($rats->birth_date) ?></td>
                            <td><?= h($rats->rattery_id) ?></td>
                            <td><?= h($rats->mother_rat_id) ?></td>
                            <td><?= h($rats->father_rat_id) ?></td>
                            <td><?= h($rats->litter_id) ?></td>
                            <td><?= h($rats->mother_rattery_id) ?></td>
                            <td><?= h($rats->father_rattery_id) ?></td>
                            <td><?= h($rats->color_id) ?></td>
                            <td><?= h($rats->eyecolor_id) ?></td>
                            <td><?= h($rats->dilution_id) ?></td>
                            <td><?= h($rats->marking_id) ?></td>
                            <td><?= h($rats->earset_id) ?></td>
                            <td><?= h($rats->coat_id) ?></td>
                            <td><?= h($rats->is_alive) ?></td>
                            <td><?= h($rats->death_date) ?></td>
                            <td><?= h($rats->death_primary_cause_id) ?></td>
                            <td><?= h($rats->death_secondary_cause_id) ?></td>
                            <td><?= h($rats->death_euthanized) ?></td>
                            <td><?= h($rats->death_diagnosed) ?></td>
                            <td><?= h($rats->death_necropsied) ?></td>
                            <td><?= h($rats->comments) ?></td>
                            <td><?= h($rats->picture) ?></td>
                            <td><?= h($rats->picture_thumbnail) ?></td>
                            <td><?= h($rats->creator_user_id) ?></td>
                            <td><?= h($rats->state_id) ?></td>
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
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($rattery->m_children_rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Mother Rat Id') ?></th>
                            <th><?= __('Father Rat Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Mother Rattery Id') ?></th>
                            <th><?= __('Father Rattery Id') ?></th>
                            <th><?= __('Color Id') ?></th>
                            <th><?= __('Eyecolor Id') ?></th>
                            <th><?= __('Dilution Id') ?></th>
                            <th><?= __('Marking Id') ?></th>
                            <th><?= __('Earset Id') ?></th>
                            <th><?= __('Coat Id') ?></th>
                            <th><?= __('Is Alive') ?></th>
                            <th><?= __('Death Date') ?></th>
                            <th><?= __('Death Primary Cause Id') ?></th>
                            <th><?= __('Death Secondary Cause Id') ?></th>
                            <th><?= __('Death Euthanized') ?></th>
                            <th><?= __('Death Diagnosed') ?></th>
                            <th><?= __('Death Necropsied') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Picture Thumbnail') ?></th>
                            <th><?= __('Creator User Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rattery->m_children_rats as $mChildrenRats) : ?>
                        <tr>
                            <td><?= h($mChildrenRats->id) ?></td>
                            <td><?= h($mChildrenRats->pedigree_identifier) ?></td>
                            <td><?= h($mChildrenRats->owner_user_id) ?></td>
                            <td><?= h($mChildrenRats->name) ?></td>
                            <td><?= h($mChildrenRats->pup_name) ?></td>
                            <td><?= h($mChildrenRats->sex) ?></td>
                            <td><?= h($mChildrenRats->birth_date) ?></td>
                            <td><?= h($mChildrenRats->rattery_id) ?></td>
                            <td><?= h($mChildrenRats->mother_rat_id) ?></td>
                            <td><?= h($mChildrenRats->father_rat_id) ?></td>
                            <td><?= h($mChildrenRats->litter_id) ?></td>
                            <td><?= h($mChildrenRats->mother_rattery_id) ?></td>
                            <td><?= h($mChildrenRats->father_rattery_id) ?></td>
                            <td><?= h($mChildrenRats->color_id) ?></td>
                            <td><?= h($mChildrenRats->eyecolor_id) ?></td>
                            <td><?= h($mChildrenRats->dilution_id) ?></td>
                            <td><?= h($mChildrenRats->marking_id) ?></td>
                            <td><?= h($mChildrenRats->earset_id) ?></td>
                            <td><?= h($mChildrenRats->coat_id) ?></td>
                            <td><?= h($mChildrenRats->is_alive) ?></td>
                            <td><?= h($mChildrenRats->death_date) ?></td>
                            <td><?= h($mChildrenRats->death_primary_cause_id) ?></td>
                            <td><?= h($mChildrenRats->death_secondary_cause_id) ?></td>
                            <td><?= h($mChildrenRats->death_euthanized) ?></td>
                            <td><?= h($mChildrenRats->death_diagnosed) ?></td>
                            <td><?= h($mChildrenRats->death_necropsied) ?></td>
                            <td><?= h($mChildrenRats->comments) ?></td>
                            <td><?= h($mChildrenRats->picture) ?></td>
                            <td><?= h($mChildrenRats->picture_thumbnail) ?></td>
                            <td><?= h($mChildrenRats->creator_user_id) ?></td>
                            <td><?= h($mChildrenRats->state_id) ?></td>
                            <td><?= h($mChildrenRats->created) ?></td>
                            <td><?= h($mChildrenRats->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $mChildrenRats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $mChildrenRats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $mChildrenRats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mChildrenRats->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($rattery->f_children_rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Mother Rat Id') ?></th>
                            <th><?= __('Father Rat Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Mother Rattery Id') ?></th>
                            <th><?= __('Father Rattery Id') ?></th>
                            <th><?= __('Color Id') ?></th>
                            <th><?= __('Eyecolor Id') ?></th>
                            <th><?= __('Dilution Id') ?></th>
                            <th><?= __('Marking Id') ?></th>
                            <th><?= __('Earset Id') ?></th>
                            <th><?= __('Coat Id') ?></th>
                            <th><?= __('Is Alive') ?></th>
                            <th><?= __('Death Date') ?></th>
                            <th><?= __('Death Primary Cause Id') ?></th>
                            <th><?= __('Death Secondary Cause Id') ?></th>
                            <th><?= __('Death Euthanized') ?></th>
                            <th><?= __('Death Diagnosed') ?></th>
                            <th><?= __('Death Necropsied') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Picture Thumbnail') ?></th>
                            <th><?= __('Creator User Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rattery->f_children_rats as $fChildrenRats) : ?>
                        <tr>
                            <td><?= h($fChildrenRats->id) ?></td>
                            <td><?= h($fChildrenRats->pedigree_identifier) ?></td>
                            <td><?= h($fChildrenRats->owner_user_id) ?></td>
                            <td><?= h($fChildrenRats->name) ?></td>
                            <td><?= h($fChildrenRats->pup_name) ?></td>
                            <td><?= h($fChildrenRats->sex) ?></td>
                            <td><?= h($fChildrenRats->birth_date) ?></td>
                            <td><?= h($fChildrenRats->rattery_id) ?></td>
                            <td><?= h($fChildrenRats->mother_rat_id) ?></td>
                            <td><?= h($fChildrenRats->father_rat_id) ?></td>
                            <td><?= h($fChildrenRats->litter_id) ?></td>
                            <td><?= h($fChildrenRats->mother_rattery_id) ?></td>
                            <td><?= h($fChildrenRats->father_rattery_id) ?></td>
                            <td><?= h($fChildrenRats->color_id) ?></td>
                            <td><?= h($fChildrenRats->eyecolor_id) ?></td>
                            <td><?= h($fChildrenRats->dilution_id) ?></td>
                            <td><?= h($fChildrenRats->marking_id) ?></td>
                            <td><?= h($fChildrenRats->earset_id) ?></td>
                            <td><?= h($fChildrenRats->coat_id) ?></td>
                            <td><?= h($fChildrenRats->is_alive) ?></td>
                            <td><?= h($fChildrenRats->death_date) ?></td>
                            <td><?= h($fChildrenRats->death_primary_cause_id) ?></td>
                            <td><?= h($fChildrenRats->death_secondary_cause_id) ?></td>
                            <td><?= h($fChildrenRats->death_euthanized) ?></td>
                            <td><?= h($fChildrenRats->death_diagnosed) ?></td>
                            <td><?= h($fChildrenRats->death_necropsied) ?></td>
                            <td><?= h($fChildrenRats->comments) ?></td>
                            <td><?= h($fChildrenRats->picture) ?></td>
                            <td><?= h($fChildrenRats->picture_thumbnail) ?></td>
                            <td><?= h($fChildrenRats->creator_user_id) ?></td>
                            <td><?= h($fChildrenRats->state_id) ?></td>
                            <td><?= h($fChildrenRats->created) ?></td>
                            <td><?= h($fChildrenRats->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $fChildrenRats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $fChildrenRats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $fChildrenRats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fChildrenRats->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Rattery Snapshots') ?></h4>
                <?php if (!empty($rattery->rattery_snapshots)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rattery->rattery_snapshots as $ratterySnapshots) : ?>
                        <tr>
                            <td><?= h($ratterySnapshots->id) ?></td>
                            <td><?= h($ratterySnapshots->data) ?></td>
                            <td><?= h($ratterySnapshots->rattery_id) ?></td>
                            <td><?= h($ratterySnapshots->state_id) ?></td>
                            <td><?= h($ratterySnapshots->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RatterySnapshots', 'action' => 'view', $ratterySnapshots->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RatterySnapshots', 'action' => 'edit', $ratterySnapshots->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RatterySnapshots', 'action' => 'delete', $ratterySnapshots->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratterySnapshots->id)]) ?>
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
