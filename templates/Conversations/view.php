<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conversation $conversation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('Edit Conversation'), ['action' => 'edit', $conversation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Conversation'), ['action' => 'delete', $conversation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conversation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Conversations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Conversation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="conversations view content">
            <h3><?= h($conversation->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rat') ?></th>
                    <td><?= $conversation->has('rat') ? $this->Html->link($conversation->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $conversation->rat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <td><?= $conversation->has('rattery') ? $this->Html->link($conversation->rattery->prefix, ['controller' => 'Ratteries', 'action' => 'view', $conversation->rattery->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Litter') ?></th>
                    <td><?= $conversation->has('litter') ? $this->Html->link($conversation->litter->id, ['controller' => 'Litters', 'action' => 'view', $conversation->litter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($conversation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($conversation->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($conversation->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $conversation->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($conversation->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Firstname') ?></th>
                            <th><?= __('Lastname') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Localization') ?></th>
                            <th><?= __('Avatar') ?></th>
                            <th><?= __('About Me') ?></th>
                            <th><?= __('Wants Newsletter') ?></th>
                            <th><?= __('Role Id') ?></th>
                            <th><?= __('Failed Login Attempts') ?></th>
                            <th><?= __('Failed Login Last Date') ?></th>
                            <th><?= __('Is Locked') ?></th>
                            <th><?= __('Staff Comments') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($conversation->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->password) ?></td>
                            <td><?= h($users->username) ?></td>
                            <td><?= h($users->firstname) ?></td>
                            <td><?= h($users->lastname) ?></td>
                            <td><?= h($users->birth_date) ?></td>
                            <td><?= h($users->sex) ?></td>
                            <td><?= h($users->localization) ?></td>
                            <td><?= h($users->avatar) ?></td>
                            <td><?= h($users->about_me) ?></td>
                            <td><?= h($users->wants_newsletter) ?></td>
                            <td><?= h($users->role_id) ?></td>
                            <td><?= h($users->failed_login_attempts) ?></td>
                            <td><?= h($users->failed_login_last_date) ?></td>
                            <td><?= h($users->is_locked) ?></td>
                            <td><?= h($users->staff_comments) ?></td>
                            <td><?= h($users->created) ?></td>
                            <td><?= h($users->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Messages') ?></h4>
                <?php if (!empty($conversation->messages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Conversation Id') ?></th>
                            <th><?= __('Content') ?></th>
                            <th><?= __('From User Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($conversation->messages as $messages) : ?>
                        <tr>
                            <td><?= h($messages->id) ?></td>
                            <td><?= h($messages->conversation_id) ?></td>
                            <td><?= h($messages->content) ?></td>
                            <td><?= h($messages->from_user_id) ?></td>
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
