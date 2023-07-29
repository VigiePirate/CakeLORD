<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'States',
                'object' => $state,
                'tooltip' => __('Browse state list'),
                'show_staff' => true
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="states view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= _('State') ?></div>
                <div class="tooltip-state">
                    <div class="current-statemark statecolor_<?php echo h($state->id) ?>"><?= h($state->symbol) ?></div>
                    <span class="tooltiptext-state hide-on-mobile"><?= h($state->name) ?></span>
                </div>
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
                <h2><?= __('Related sheets') ?></h2>
                <details>
                    <summary><?= __('Related rats') ?></summary>
                    <div class="button-raised">
                        <?= $this->Html->link(__('See all rats in this state'), ['controller' => 'Rats', 'action' => 'inState', $state->id], ['class' => 'button float-right']) ?>
                    </div>
                    <table><tr><td><?= __('{0, plural, =0{No rat sheet is} =1{<strong>1 rat sheet</strong> is} other{<strong># rat sheets</strong> are}} currently in this state.', [$counts['rats']]) ?></td></tr></table>
                </details>
                <details>
                    <summary><?= __('Related ratteries') ?></summary>
                    <div class="button-raised">
                        <?= $this->Html->link(__('See all ratteries in this state'), ['controller' => 'Ratteries', 'action' => 'inState', $state->id], ['class' => 'button float-right']) ?>
                    </div>
                    <table><tr><td><?= __('{0, plural, =0{No rattery sheet is} =1{<strong>1 rattery sheet</strong> is} other{<strong># rattery sheets</strong> are}} currently in this state.', [$counts['ratteries']]) ?></td></tr></table>

                </details>
                <details>
                    <summary><?= __('Related litters') ?></summary>
                    <div class="button-raised">
                        <?= $this->Html->link(__('See all litters in this state'), ['controller' => 'Litters', 'action' => 'inState', $state->id], ['class' => 'button float-right']) ?>
                    </div>
                    <table><tr><td><?= __('{0, plural, =0{No litter sheet is} =1{<strong>1 litter sheet</strong> is} other{<strong># litter sheets</strong> are}} currently in this state.', [$counts['litters']]) ?></td></tr></table>
                </details>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
