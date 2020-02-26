<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Litter'), ['action' => 'edit', $litter->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Litter'), ['action' => 'delete', $litter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litter->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Litters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Litter'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="litters view content">
            <h3><?= h($litter->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $litter->has('rattery') ? $this->Html->link($litter->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $litter->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $litter->has('user') ? $this->Html->link($litter->user->username, ['controller' => 'Users', 'action' => 'view', $litter->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $litter->has('state') ? $this->Html->link($litter->state->name, ['controller' => 'States', 'action' => 'view', $litter->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($litter->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mother Rat Id') ?></th>
                    <td><?= $this->Number->format($litter->mother_rat_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Father Rat Id') ?></th>
                    <td><?= $this->Number->format($litter->father_rat_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pups Number') ?></th>
                    <td><?= $this->Number->format($litter->pups_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pups Number Stillborn') ?></th>
                    <td><?= $this->Number->format($litter->pups_number_stillborn) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mating Date') ?></th>
                    <td><?= h($litter->mating_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth Date') ?></th>
                    <td><?= h($litter->birth_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($litter->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($litter->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($litter->comments)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($litter->rats)) : ?>
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
                        <?php foreach ($litter->rats as $rats) : ?>
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
                <h4><?= __('Related Conversations') ?></h4>
                <?php if (!empty($litter->conversations)) : ?>
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
                        <?php foreach ($litter->conversations as $conversations) : ?>
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
                <h4><?= __('Related Litter Snapshots') ?></h4>
                <?php if (!empty($litter->litter_snapshots)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($litter->litter_snapshots as $litterSnapshots) : ?>
                        <tr>
                            <td><?= h($litterSnapshots->id) ?></td>
                            <td><?= h($litterSnapshots->data) ?></td>
                            <td><?= h($litterSnapshots->litter_id) ?></td>
                            <td><?= h($litterSnapshots->state_id) ?></td>
                            <td><?= h($litterSnapshots->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'LitterSnapshots', 'action' => 'view', $litterSnapshots->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'LitterSnapshots', 'action' => 'edit', $litterSnapshots->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'LitterSnapshots', 'action' => 'delete', $litterSnapshots->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litterSnapshots->id)]) ?>
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
