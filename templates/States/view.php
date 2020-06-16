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
                    <th><?= __('Symbol') ?></th>
                    <td><?= h($state->symbol) ?></td>
                </tr>
                <tr>
                    <th><?= __('Css Property') ?></th>
                    <td><?= h($state->css_property) ?></td>
                </tr>
                <tr>
                    <th><?= __('Next Ok State') ?></th>
                    <td><?= $state->has('next_ok_state') ? $this->Html->link($state->next_ok_state->name, ['controller' => 'States', 'action' => 'view', $state->next_ok_state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Next Ko State') ?></th>
                    <td><?= $state->has('next_ko_state') ? $this->Html->link($state->next_ko_state->name, ['controller' => 'States', 'action' => 'view', $state->next_ko_state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Next Frozen State') ?></th>
                    <td><?= $state->has('next_frozen_state') ? $this->Html->link($state->next_frozen_state->name, ['controller' => 'States', 'action' => 'view', $state->next_frozen_state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Next Thawed State') ?></th>
                    <td><?= $state->has('next_thawed_state') ? $this->Html->link($state->next_thawed_state->name, ['controller' => 'States', 'action' => 'view', $state->next_thawed_state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($state->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Default') ?></th>
                    <td><?= $state->is_default ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Needs User Action') ?></th>
                    <td><?= $state->needs_user_action ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Needs Staff Action') ?></th>
                    <td><?= $state->needs_staff_action ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Reliable') ?></th>
                    <td><?= $state->is_reliable ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Visible') ?></th>
                    <td><?= $state->is_visible ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Searchable') ?></th>
                    <td><?= $state->is_searchable ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Frozen') ?></th>
                    <td><?= $state->is_frozen ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Litter Snapshots') ?></h4>
                <?php if (!empty($state->litter_snapshots)) : ?>
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
                        <?php foreach ($state->litter_snapshots as $litterSnapshots) : ?>
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
                <h4><?= __('Related Litters') ?></h4>
                <?php if (!empty($state->litters)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
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
                        <?php foreach ($state->litters as $litters) : ?>
                        <tr>
                            <td><?= h($litters->id) ?></td>
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
                <h4><?= __('Related Rat Snapshots') ?></h4>
                <?php if (!empty($state->rat_snapshots)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Rat Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->rat_snapshots as $ratSnapshots) : ?>
                        <tr>
                            <td><?= h($ratSnapshots->id) ?></td>
                            <td><?= h($ratSnapshots->data) ?></td>
                            <td><?= h($ratSnapshots->rat_id) ?></td>
                            <td><?= h($ratSnapshots->state_id) ?></td>
                            <td><?= h($ratSnapshots->created) ?></td>
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
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($state->rats)) : ?>
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
                        <?php foreach ($state->rats as $rats) : ?>
                        <tr>
                            <td><?= h($rats->id) ?></td>
                            <td><?= h($rats->pedigree_identifier) ?></td>
                            <td><?= h($rats->is_pedigree_custom) ?></td>
                            <td><?= h($rats->owner_user_id) ?></td>
                            <td><?= h($rats->name) ?></td>
                            <td><?= h($rats->pup_name) ?></td>
                            <td><?= h($rats->sex) ?></td>
                            <td><?= h($rats->birth_date) ?></td>
                            <td><?= h($rats->rattery_id) ?></td>
                            <td><?= h($rats->litter_id) ?></td>
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
                <h4><?= __('Related Ratteries') ?></h4>
                <?php if (!empty($state->ratteries)) : ?>
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
                        <?php foreach ($state->ratteries as $ratteries) : ?>
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
                <h4><?= __('Related Rattery Snapshots') ?></h4>
                <?php if (!empty($state->rattery_snapshots)) : ?>
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
                        <?php foreach ($state->rattery_snapshots as $ratterySnapshots) : ?>
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
