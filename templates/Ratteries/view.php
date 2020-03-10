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
                    <th><?= __('Country') ?></th>
                    <td><?= $rattery->has('country') ? $this->Html->link($rattery->country->name, ['controller' => 'Countries', 'action' => 'view', $rattery->country->id]) : '' ?></td>
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
                <tr>
                    <th><?= __('Is Generic') ?></th>
                    <td><?= $rattery->is_generic ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Wants Statistic') ?></th>
                    <td><?= $rattery->wants_statistic ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($rattery->comments)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Litters') ?></h4>
                <?php if (!empty($rattery->litters)) : ?>
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
                        <?php foreach ($rattery->litters as $litters) : ?>
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
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($rattery->rats)) : ?>
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
                            <td><?= h($rats->is_pedigree_custom) ?></td>
                            <td><?= h($rats->owner_user_id) ?></td>
                            <td><?= h($rats->name) ?></td>
                            <td><?= h($rats->pup_name) ?></td>
                            <td><?= h($rats->sex) ?></td>
                            <td><?= h($rats->birth_date) ?></td>
                            <td><?= h($rats->rattery_id) ?></td>
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
