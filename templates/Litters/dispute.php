<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
 * @var \Cake\Collection\CollectionInterface|string[] $users
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
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['action' => 'view', $litter->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back') ?></span>
                </div>
            </diV>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>

            <h1><?=__('Send sheet back to staff') ?></h1>

            <div class="message default">
                <?= __('You have chosen to send back your sheet to the back office without editing it by yourself. Please read again the last notification from staff and, if you still want to proceed, type your answer before clicking the button.') ?>
            </div>

            <h2><?= __('Review sheet history') ?></h2>

            <h3><?= __('Last notification from staff') ?></h3>

            <div class="message error text">
                    <blockquote>
                        <?= ! empty($litter->litter_messages) ? $litter->litter_messages[0]->content : '' ?>
                    </blockquote>
            </div>

            <details>
                <summary>
                    <?= __('Older notifications') ?>
                </summary>
                <?php if (!empty($litter->litter_messages)) : ?>
                    <div class="table-responsive">
                        <table class="summary highlightable">
                            <thead>
                                <tr>
                                    <th><?= __x('message', 'Created') ?></th>
                                    <th><?= __x('message', 'Sent by') ?></th>


                                    <th><?= __('Message') ?></th>

                                    <!-- <th><?= __('Staff?') ?></th> -->
                                    <th><?= __('Auto?') ?></th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($litter->litter_messages as $litterMessage): ?>
                                    <tr>
                                        <td><?= h($litterMessage->created->i18nFormat('dd/MM/yyyy')) ?></td>
                                        <td>
                                            <?=
                                                $litterMessage->has('user') && ! $litterMessage->is_automatically_generated
                                                ? h($litterMessage->user->username)
                                                : __('LORD')
                                            ?>
                                        </td>

                                        <td class="ellipsis" onclick="toggleMessage(this)"><?= h($litterMessage->content) ?></td>
                                        <td><?= $litterMessage->is_automatically_generated ? '✓' : '' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif ; ?>
            </details>

            <h2><?= __('Your answer') ?></h2>

            <?= $this->Form->create($litter, ['type' => 'post', 'url' => ['action' => 'dispute', $litter->id]]) ?>
            <fieldset>
                <?=
                    $this->element('side_message_control', [
                        'user' => $identity,
                        'sheet' => $litter,
                        'label' => __('Type here all helpful information'),
                        'required' => true,
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Send to back office'), ['name' => 'decision', 'value' => 'blame']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
