<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatteryMessage $ratteryMessage
 * @var string[]|\Cake\Collection\CollectionInterface $rats
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar', isset($help_url) ? $help_url : ['controller' => 'Faqs', 'action' => 'all']) ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'RatteryMessages', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('List')]) ?>
                        <span class="tooltiptext"><?= __('Back to open issue list') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'RatteryMessages',
                    'object' => $ratteryMessage,
                    'can_cancel' => true,
                    'user' => $identity
                ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="issues view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('RatteryMessages') ?></div>
            </div>

            <h1><?= __('Edit RatteryMessage #') . $ratteryMessage->id ?></h1>

            <h2><?= __('Context') ?></h2>

            <table class="condensed">
                <tr>
                    <th><?= __x('message', 'Created') ?></th>
                    <td><?= h($ratteryMessage->created) ?></td>
                </tr>
                <tr>
                    <th><?= __x('message', 'Sent by') ?></th>
                    <td><?= $this->Html->link($ratteryMessage->user->username, ['controller' => 'Users', 'action' => 'view', $ratteryMessage->user->id]) ?></td>
                </tr>
                <tr>
                    <th><?= __x('message', 'About') ?></th>
                    <td><?= $ratteryMessage->has('rattery') ? $this->Html->link($ratteryMessage->rattery->full_name, ['controller' => 'Ratteries', 'action' => 'view', $ratteryMessage->rattery->id]) : '' ?></td>
            </table>

            <h2><?= __x('message', 'Content') ?></h2>

            <?= $this->Form->create($ratteryMessage) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('content', ['label' => __('Edit message')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Edit message')) ?>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>
