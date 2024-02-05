<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatMessage $ratMessage
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
                        'url' => ['controller' => 'RatMessages', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('List')]) ?>
                        <span class="tooltiptext"><?= __('Back to open issue list') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'RatMessages',
                    'object' => $ratMessage,
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
                <div class="sheet-title pretitle"><?= __('RatMessages') ?></div>
            </div>

            <h1><?= __('Edit RatMessage #') . $ratMessage->id ?></h1>

            <h2><?= __('Context') ?></h2>

            <table class="condensed">
                <tr>
                    <th><?= __x('message', 'Created') ?></th>
                    <td><?= h($ratMessage->created) ?></td>
                </tr>
                <tr>
                    <th><?= __x('message', 'Sent by') ?></th>
                    <td><?= $this->Html->link($ratMessage->user->username, ['controller' => 'Users', 'action' => 'view', $ratMessage->user->id]) ?></td>
                </tr>
                <tr>
                    <th><?= __x('message', 'About') ?></th>
                    <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?> – <?= h($ratMessage->rat->usual_name) ?></td>
            </table>

            <h2><?= __x('message', 'Content') ?></h2>

            <?= $this->Form->create($ratMessage) ?>
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
