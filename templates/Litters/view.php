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
            <h3><?= h($litter->full_name) ?></h3>
            <table>
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
                <?php if (!empty($litter->parent_rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Is Pedigree Custom') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
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
                        <?php foreach ($litter->parent_rats as $parentRats) : ?>
                        <tr>
                            <td><?= h($parentRats->id) ?></td>
                            <td><?= h($parentRats->pedigree_identifier) ?></td>
                            <td><?= h($parentRats->is_pedigree_custom) ?></td>
                            <td><?= h($parentRats->owner_user_id) ?></td>
                            <td><?= h($parentRats->name) ?></td>
                            <td><?= h($parentRats->pup_name) ?></td>
                            <td><?= h($parentRats->sex) ?></td>
                            <td><?= h($parentRats->birth_date) ?></td>
                            <td><?= h($parentRats->rattery_id) ?></td>
                            <td><?= h($parentRats->litter_id) ?></td>
                            <td><?= h($parentRats->color_id) ?></td>
                            <td><?= h($parentRats->eyecolor_id) ?></td>
                            <td><?= h($parentRats->dilution_id) ?></td>
                            <td><?= h($parentRats->marking_id) ?></td>
                            <td><?= h($parentRats->earset_id) ?></td>
                            <td><?= h($parentRats->coat_id) ?></td>
                            <td><?= h($parentRats->is_alive) ?></td>
                            <td><?= h($parentRats->death_date) ?></td>
                            <td><?= h($parentRats->death_primary_cause_id) ?></td>
                            <td><?= h($parentRats->death_secondary_cause_id) ?></td>
                            <td><?= h($parentRats->death_euthanized) ?></td>
                            <td><?= h($parentRats->death_diagnosed) ?></td>
                            <td><?= h($parentRats->death_necropsied) ?></td>
                            <td><?= h($parentRats->comments) ?></td>
                            <td><?= h($parentRats->picture) ?></td>
                            <td><?= h($parentRats->picture_thumbnail) ?></td>
                            <td><?= h($parentRats->creator_user_id) ?></td>
                            <td><?= h($parentRats->state_id) ?></td>
                            <td><?= h($parentRats->created) ?></td>
                            <td><?= h($parentRats->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $parentRats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $parentRats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $parentRats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parentRats->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Ratteries') ?></h4>
                <?php if (!empty($litter->ratteries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Prefix') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Birth Year') ?></th>
                            <th><?= __('Is Alive') ?></th>
                            <th><?= __('Is Generic') ?></th>
                            <th><?= __('District') ?></th>
                            <th><?= __('Zip Code') ?></th>
                            <th><?= __('Country Id') ?></th>
                            <th><?= __('Website') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Wants Statistic') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($litter->ratteries as $ratteries) : ?>
                        <tr>
                            <td><?= h($ratteries->id) ?></td>
                            <td><?= h($ratteries->prefix) ?></td>
                            <td><?= h($ratteries->name) ?></td>
                            <td><?= h($ratteries->owner_user_id) ?></td>
                            <td><?= h($ratteries->birth_year) ?></td>
                            <td><?= h($ratteries->is_alive) ?></td>
                            <td><?= h($ratteries->is_generic) ?></td>
                            <td><?= h($ratteries->district) ?></td>
                            <td><?= h($ratteries->zip_code) ?></td>
                            <td><?= h($ratteries->country_id) ?></td>
                            <td><?= h($ratteries->website) ?></td>
                            <td><?= h($ratteries->comments) ?></td>
                            <td><?= h($ratteries->wants_statistic) ?></td>
                            <td><?= h($ratteries->picture) ?></td>
                            <td><?= h($ratteries->state_id) ?></td>
                            <td><?= h($ratteries->created) ?></td>
                            <td><?= h($ratteries->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Ratteries', 'action' => 'view', $ratteries->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Ratteries', 'action' => 'edit', $ratteries->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ratteries', 'action' => 'delete', $ratteries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratteries->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Litters Contributions') ?></h4>
                <?php if (!empty($litter->contributions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Priority') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($litter->contributions as $contributions) : ?>
                        <tr>
                            <td><?= h($contributions->id) ?></td>
                            <td><?= h($contributions->name) ?></td>
                            <td><?= h($contributions->priority) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'LittersContributions', 'action' => 'view', $contributions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'LittersContributions', 'action' => 'edit', $contributions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'LittersContributions', 'action' => 'delete', $contributions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contributions->id)]) ?>
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
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($litter->offspring_rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Is Pedigree Custom') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
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
                        <?php foreach ($litter->offspring_rats as $offspringRats) : ?>
                        <tr>
                            <td><?= h($offspringRats->id) ?></td>
                            <td><?= h($offspringRats->pedigree_identifier) ?></td>
                            <td><?= h($offspringRats->is_pedigree_custom) ?></td>
                            <td><?= h($offspringRats->owner_user_id) ?></td>
                            <td><?= h($offspringRats->name) ?></td>
                            <td><?= h($offspringRats->pup_name) ?></td>
                            <td><?= h($offspringRats->sex) ?></td>
                            <td><?= h($offspringRats->birth_date) ?></td>
                            <td><?= h($offspringRats->rattery_id) ?></td>
                            <td><?= h($offspringRats->litter_id) ?></td>
                            <td><?= h($offspringRats->color_id) ?></td>
                            <td><?= h($offspringRats->eyecolor_id) ?></td>
                            <td><?= h($offspringRats->dilution_id) ?></td>
                            <td><?= h($offspringRats->marking_id) ?></td>
                            <td><?= h($offspringRats->earset_id) ?></td>
                            <td><?= h($offspringRats->coat_id) ?></td>
                            <td><?= h($offspringRats->is_alive) ?></td>
                            <td><?= h($offspringRats->death_date) ?></td>
                            <td><?= h($offspringRats->death_primary_cause_id) ?></td>
                            <td><?= h($offspringRats->death_secondary_cause_id) ?></td>
                            <td><?= h($offspringRats->death_euthanized) ?></td>
                            <td><?= h($offspringRats->death_diagnosed) ?></td>
                            <td><?= h($offspringRats->death_necropsied) ?></td>
                            <td><?= h($offspringRats->comments) ?></td>
                            <td><?= h($offspringRats->picture) ?></td>
                            <td><?= h($offspringRats->picture_thumbnail) ?></td>
                            <td><?= h($offspringRats->creator_user_id) ?></td>
                            <td><?= h($offspringRats->state_id) ?></td>
                            <td><?= h($offspringRats->created) ?></td>
                            <td><?= h($offspringRats->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $offspringRats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $offspringRats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $offspringRats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offspringRats->id)]) ?>
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
