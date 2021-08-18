<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-report.svg', [
                'url' => ['controller' => 'Conversations', 'action' => 'add'],
                'class' => 'side-nav-icon',
                'alt' => __('Report')]) ?>
            <?= $this->Html->image('/img/icon-help.svg', [
                'url' => ['controller' => 'Articles', 'action' => 'index'],
                'class' => 'side-nav-icon',
                'alt' => __('Help')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->image('/img/icon-search-rats.svg', [
                  'url' => ['controller' => 'Rats', 'action' => 'inState', $state->id],
                  'class' => 'side-nav-icon',
                  'alt' => __('Find their rats')]) ?>
            <div class="spacer"> </div>
            <?= $this->Html->link(__('Edit State'), ['action' => 'edit', $state->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete State'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New State'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="states view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Sheet State') ?></div>
                <div class="statemark statecolor_<?= h($state->id) ?>"><?= h($state->symbol) ?></div>
            </div>
            <h1><?= h($state->name) ?></h1>

            <h2><?= __('Reference information') ?></h2>
            <h3><?= __('Description') ?></h3>
            <table class="condensed">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($state->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($state->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Symbol') ?></th>
                    <td><?= h($state->symbol) ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= h($state->color) ?></td>
                </tr>
                <tr>
                    <th><?= __('Css Property') ?></th>
                    <td><?= h($state->css_property) ?></td>
                </tr>
            </table>
            <h3><?= __('Properties') ?></h3>
            <table class="condensed">
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

            <h3><?= __('Workflow') ?></h3>
            <table class="condensed">
                <tr>
                    <th><?= __('Next OK State') ?></th>
                    <td><?= $state->has('next_ok_state') ? $this->Html->link($state->next_ok_state->name, ['controller' => 'States', 'action' => 'view', $state->next_ok_state->id]) : '' ?></td>
                </tr>

                <tr>
                    <th><?= __('Next KO State') ?></th>
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
            </table>

            <div class="related">
                <h2><?= __('Related sheets and snapshots') ?></h2>
                <div class="related">
                    <details>
                        <summary><?= __('Related rats') ?></summary>
                        <p><strong>xx <?= __('rat sheets') ?></strong> <?= __('are currently in this state.') ?> </p>
                    </details>
                </div>
                <div class="related">
                    <details>
                        <summary><?= __('Related ratteries') ?></summary>
                        <p><strong>yy <?= __('rattery sheets') ?></strong> <?= __('are currently in this state.') ?> </p>
                    </details>
                </div>
                <div class="related">
                    <details>
                        <summary><?= __('Related litters') ?></summary>
                        <p><strong>zz <?= __('litter sheets') ?></strong> <?= __('are currently in this state.') ?> </p>
                    </details>
                </div>
            </div>
        </div>
    </div>
</div>
