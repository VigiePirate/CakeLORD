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
                    <th><?= __('Date Birth') ?></th>
                    <td><?= h($rattery->date_birth) ?></td>
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
                    <th><?= __('Status') ?></th>
                    <td><?= $rattery->status ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Validated') ?></th>
                    <td><?= $rattery->validated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($rattery->comments)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Backoffice Rattery Messages') ?></h4>
                <?php if (!empty($rattery->backoffice_rattery_messages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Staff Id') ?></th>
                            <th><?= __('Staff Comments') ?></th>
                            <th><?= __('Owner Comments') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rattery->backoffice_rattery_messages as $backofficeRatteryMessages) : ?>
                        <tr>
                            <td><?= h($backofficeRatteryMessages->id) ?></td>
                            <td><?= h($backofficeRatteryMessages->rattery_id) ?></td>
                            <td><?= h($backofficeRatteryMessages->staff_id) ?></td>
                            <td><?= h($backofficeRatteryMessages->staff_comments) ?></td>
                            <td><?= h($backofficeRatteryMessages->owner_comments) ?></td>
                            <td><?= h($backofficeRatteryMessages->created) ?></td>
                            <td><?= h($backofficeRatteryMessages->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'BackofficeRatteryMessages', 'action' => 'view', $backofficeRatteryMessages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'BackofficeRatteryMessages', 'action' => 'edit', $backofficeRatteryMessages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'BackofficeRatteryMessages', 'action' => 'delete', $backofficeRatteryMessages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatteryMessages->id)]) ?>
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
