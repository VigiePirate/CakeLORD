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
            <h3><?= h($rattery->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($rattery->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prefix') ?></th>
                    <td><?= h($rattery->prefix) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->id, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($rattery->picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth Year') ?></th>
                    <td><?= h($rattery->birth_year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rattery->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('State Id') ?></th>
                    <td><?= $this->Number->format($rattery->state_id) ?></td>
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
        </div>
    </div>
</div>
