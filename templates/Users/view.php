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
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
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
                    <th><?= __('Sex') ?></th>
                    <td><?= h($user->sex) ?></td>
                </tr>
                <tr>
                    <th><?= __('Localization') ?></th>
                    <td><?= h($user->localization) ?></td>
                </tr>
                <tr>
                    <th><?= __('Avatar') ?></th>
                    <td><?= h($user->avatar) ?></td>
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
                    <th><?= __('Failed Login Last Date') ?></th>
                    <td><?= h($user->failed_login_last_date) ?></td>
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
                    <th><?= __('Wants Newsletter') ?></th>
                    <td><?= $user->wants_newsletter ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Locked') ?></th>
                    <td><?= $user->is_locked ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('About Me') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->about_me)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Staff Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->staff_comments)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Conversations') ?></h4>
                <?php if (!empty($user->conversations)) : ?>
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
                        <?php foreach ($user->conversations as $conversations) : ?>
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
                <?php if (!empty($user->owner_rats)) : ?>
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
                        <?php foreach ($user->owner_rats as $ownerRats) : ?>
                        <tr>
                            <td><?= h($ownerRats->id) ?></td>
                            <td><?= h($ownerRats->pedigree_identifier) ?></td>
                            <td><?= h($ownerRats->is_pedigree_custom) ?></td>
                            <td><?= h($ownerRats->owner_user_id) ?></td>
                            <td><?= h($ownerRats->name) ?></td>
                            <td><?= h($ownerRats->pup_name) ?></td>
                            <td><?= h($ownerRats->sex) ?></td>
                            <td><?= h($ownerRats->birth_date) ?></td>
                            <td><?= h($ownerRats->rattery_id) ?></td>
                            <td><?= h($ownerRats->color_id) ?></td>
                            <td><?= h($ownerRats->eyecolor_id) ?></td>
                            <td><?= h($ownerRats->dilution_id) ?></td>
                            <td><?= h($ownerRats->marking_id) ?></td>
                            <td><?= h($ownerRats->earset_id) ?></td>
                            <td><?= h($ownerRats->coat_id) ?></td>
                            <td><?= h($ownerRats->is_alive) ?></td>
                            <td><?= h($ownerRats->death_date) ?></td>
                            <td><?= h($ownerRats->death_primary_cause_id) ?></td>
                            <td><?= h($ownerRats->death_secondary_cause_id) ?></td>
                            <td><?= h($ownerRats->death_euthanized) ?></td>
                            <td><?= h($ownerRats->death_diagnosed) ?></td>
                            <td><?= h($ownerRats->death_necropsied) ?></td>
                            <td><?= h($ownerRats->comments) ?></td>
                            <td><?= h($ownerRats->picture) ?></td>
                            <td><?= h($ownerRats->picture_thumbnail) ?></td>
                            <td><?= h($ownerRats->creator_user_id) ?></td>
                            <td><?= h($ownerRats->state_id) ?></td>
                            <td><?= h($ownerRats->created) ?></td>
                            <td><?= h($ownerRats->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $ownerRats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $ownerRats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $ownerRats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ownerRats->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($user->creator_rats)) : ?>
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
                        <?php foreach ($user->creator_rats as $creatorRats) : ?>
                        <tr>
                            <td><?= h($creatorRats->id) ?></td>
                            <td><?= h($creatorRats->pedigree_identifier) ?></td>
                            <td><?= h($creatorRats->is_pedigree_custom) ?></td>
                            <td><?= h($creatorRats->owner_user_id) ?></td>
                            <td><?= h($creatorRats->name) ?></td>
                            <td><?= h($creatorRats->pup_name) ?></td>
                            <td><?= h($creatorRats->sex) ?></td>
                            <td><?= h($creatorRats->birth_date) ?></td>
                            <td><?= h($creatorRats->rattery_id) ?></td>
                            <td><?= h($creatorRats->color_id) ?></td>
                            <td><?= h($creatorRats->eyecolor_id) ?></td>
                            <td><?= h($creatorRats->dilution_id) ?></td>
                            <td><?= h($creatorRats->marking_id) ?></td>
                            <td><?= h($creatorRats->earset_id) ?></td>
                            <td><?= h($creatorRats->coat_id) ?></td>
                            <td><?= h($creatorRats->is_alive) ?></td>
                            <td><?= h($creatorRats->death_date) ?></td>
                            <td><?= h($creatorRats->death_primary_cause_id) ?></td>
                            <td><?= h($creatorRats->death_secondary_cause_id) ?></td>
                            <td><?= h($creatorRats->death_euthanized) ?></td>
                            <td><?= h($creatorRats->death_diagnosed) ?></td>
                            <td><?= h($creatorRats->death_necropsied) ?></td>
                            <td><?= h($creatorRats->comments) ?></td>
                            <td><?= h($creatorRats->picture) ?></td>
                            <td><?= h($creatorRats->picture_thumbnail) ?></td>
                            <td><?= h($creatorRats->creator_user_id) ?></td>
                            <td><?= h($creatorRats->state_id) ?></td>
                            <td><?= h($creatorRats->created) ?></td>
                            <td><?= h($creatorRats->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $creatorRats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $creatorRats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $creatorRats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $creatorRats->id)]) ?>
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
