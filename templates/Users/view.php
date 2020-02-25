<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->username) ?></h3>
            <table>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($user->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sex') ?></th>
                    <td><?= h($user->sex) ?></td>
                </tr>
                <tr>
                    <th><?= __('Firstname') ?></th>
                    <td><?= h($user->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lastname') ?></th>
                    <td><?= h($user->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Failed Login Attempts') ?></th>
                    <td><?= $this->Number->format($user->failed_login_attempts) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth Date') ?></th>
                    <td><?= h($user->birth_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Failed Login Last Date') ?></th>
                    <td><?= h($user->failed_login_last_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Newsletter') ?></th>
                    <td><?= $user->newsletter ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Locked') ?></th>
                    <td><?= $user->is_locked ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Conversations') ?></h4>
                <?php if (!empty($user->conversations)) : ?>
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
                        <?php foreach ($user->conversations as $conversations) : ?>
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
                <h4><?= __('Related Ratteries') ?></h4>
                <?php if (!empty($user->ratteries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Prefix') ?></th>
                            <th><?= __('Owner Id') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Is Alive') ?></th>
                            <th><?= __('Birth Year') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->ratteries as $ratteries) : ?>
                        <tr>
                            <td><?= h($ratteries->id) ?></td>
                            <td><?= h($ratteries->name) ?></td>
                            <td><?= h($ratteries->prefix) ?></td>
                            <td><?= h($ratteries->owner_id) ?></td>
                            <td><?= h($ratteries->comments) ?></td>
                            <td><?= h($ratteries->picture) ?></td>
                            <td><?= h($ratteries->is_alive) ?></td>
                            <td><?= h($ratteries->birth_year) ?></td>
                            <td><?= h($ratteries->created) ?></td>
                            <td><?= h($ratteries->modified) ?></td>
                            <td><?= h($ratteries->state_id) ?></td>
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
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($user->owned_rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
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
                            <th><?= __('Is Alive') ?></th>
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
                            <th><?= __('Rattery Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->owned_rats as $ownedRats) : ?>
                        <tr>
                            <td><?= h($ownedRats->id) ?></td>
                            <td><?= h($ownedRats->name) ?></td>
                            <td><?= h($ownedRats->pup_name) ?></td>
                            <td><?= h($ownedRats->sex) ?></td>
                            <td><?= h($ownedRats->pedigree_identifier) ?></td>
                            <td><?= h($ownedRats->birth_date) ?></td>
                            <td><?= h($ownedRats->death_date) ?></td>
                            <td><?= h($ownedRats->death_primary_cause_id) ?></td>
                            <td><?= h($ownedRats->death_secondary_cause_id) ?></td>
                            <td><?= h($ownedRats->death_euthanized) ?></td>
                            <td><?= h($ownedRats->death_diagnosed) ?></td>
                            <td><?= h($ownedRats->death_necropsied) ?></td>
                            <td><?= h($ownedRats->picture) ?></td>
                            <td><?= h($ownedRats->picture_thumbnail) ?></td>
                            <td><?= h($ownedRats->comments) ?></td>
                            <td><?= h($ownedRats->is_alive) ?></td>
                            <td><?= h($ownedRats->mother_rattery_id) ?></td>
                            <td><?= h($ownedRats->father_rattery_id) ?></td>
                            <td><?= h($ownedRats->mother_rat_id) ?></td>
                            <td><?= h($ownedRats->father_rat_id) ?></td>
                            <td><?= h($ownedRats->litter_id) ?></td>
                            <td><?= h($ownedRats->owner_user_id) ?></td>
                            <td><?= h($ownedRats->color_id) ?></td>
                            <td><?= h($ownedRats->earset_id) ?></td>
                            <td><?= h($ownedRats->eyecolor_id) ?></td>
                            <td><?= h($ownedRats->dilution_id) ?></td>
                            <td><?= h($ownedRats->coat_id) ?></td>
                            <td><?= h($ownedRats->marking_id) ?></td>
                            <td><?= h($ownedRats->creator_user_id) ?></td>
                            <td><?= h($ownedRats->created) ?></td>
                            <td><?= h($ownedRats->modified) ?></td>
                            <td><?= h($ownedRats->state_id) ?></td>
                            <td><?= h($ownedRats->rattery_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $ownedRats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $ownedRats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $ownedRats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ownedRats->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($user->created_rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
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
                            <th><?= __('Is Alive') ?></th>
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
                            <th><?= __('Rattery Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->created_rats as $createdRats) : ?>
                        <tr>
                            <td><?= h($createdRats->id) ?></td>
                            <td><?= h($createdRats->name) ?></td>
                            <td><?= h($createdRats->pup_name) ?></td>
                            <td><?= h($createdRats->sex) ?></td>
                            <td><?= h($createdRats->pedigree_identifier) ?></td>
                            <td><?= h($createdRats->birth_date) ?></td>
                            <td><?= h($createdRats->death_date) ?></td>
                            <td><?= h($createdRats->death_primary_cause_id) ?></td>
                            <td><?= h($createdRats->death_secondary_cause_id) ?></td>
                            <td><?= h($createdRats->death_euthanized) ?></td>
                            <td><?= h($createdRats->death_diagnosed) ?></td>
                            <td><?= h($createdRats->death_necropsied) ?></td>
                            <td><?= h($createdRats->picture) ?></td>
                            <td><?= h($createdRats->picture_thumbnail) ?></td>
                            <td><?= h($createdRats->comments) ?></td>
                            <td><?= h($createdRats->is_alive) ?></td>
                            <td><?= h($createdRats->mother_rattery_id) ?></td>
                            <td><?= h($createdRats->father_rattery_id) ?></td>
                            <td><?= h($createdRats->mother_rat_id) ?></td>
                            <td><?= h($createdRats->father_rat_id) ?></td>
                            <td><?= h($createdRats->litter_id) ?></td>
                            <td><?= h($createdRats->owner_user_id) ?></td>
                            <td><?= h($createdRats->color_id) ?></td>
                            <td><?= h($createdRats->earset_id) ?></td>
                            <td><?= h($createdRats->eyecolor_id) ?></td>
                            <td><?= h($createdRats->dilution_id) ?></td>
                            <td><?= h($createdRats->coat_id) ?></td>
                            <td><?= h($createdRats->marking_id) ?></td>
                            <td><?= h($createdRats->creator_user_id) ?></td>
                            <td><?= h($createdRats->created) ?></td>
                            <td><?= h($createdRats->modified) ?></td>
                            <td><?= h($createdRats->state_id) ?></td>
                            <td><?= h($createdRats->rattery_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $createdRats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $createdRats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $createdRats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $createdRats->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Messages') ?></h4>
                <?php if (!empty($user->messages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Conversation Id') ?></th>
                            <th><?= __('Content') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->messages as $messages) : ?>
                        <tr>
                            <td><?= h($messages->id) ?></td>
                            <td><?= h($messages->conversation_id) ?></td>
                            <td><?= h($messages->content) ?></td>
                            <td><?= h($messages->user_id) ?></td>
                            <td><?= h($messages->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Messages', 'action' => 'view', $messages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Messages', 'action' => 'edit', $messages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Messages', 'action' => 'delete', $messages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messages->id)]) ?>
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
