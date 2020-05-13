<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit State'), ['action' => 'edit', $state->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete State'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List States'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New State'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="states view content">
            <h3><?= h($state->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($state->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= h($state->color) ?></td>
                </tr>
                <tr>
                    <th><?= __('Symbol') ?></th>
                    <td><?= h($state->symbol) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($state->id) ?></td>
                </tr>
            </table>

            <div class="related">
                <h4><?= __('Related Litters') ?></h4>
                <?php if (!empty($state->litters)) : ?>
                <div class="table-responsive summary">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->litters as $litters) : ?>
                        <tr>
                            <td><?= h($litters->id) ?></td>
                            <td><?= h($litters->birth_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Litters', 'action' => 'view', $litters->id]) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>

            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($state->rats)) : ?>
                <div class="table-responsive">
                    <table class="summary">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->rats as $rats) : ?>
                        <tr>
                            <td><?= h($rats->id) ?></td>
                            <td><?= h($rats->pedigree_identifier) ?></td>
                            <td><?= h($rats->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $rats->id]) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Ratteries') ?></h4>
                <?php if (!empty($state->ratteries)) : ?>
                <div class="table-responsive summary">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Prefix') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->ratteries as $ratteries) : ?>
                        <tr>
                            <td><?= h($ratteries->id) ?></td>
                            <td><?= h($ratteries->prefix) ?></td>
                            <td><?= h($ratteries->name) ?></td>
                            <td><?= h($ratteries->owner_user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Ratteries', 'action' => 'view', $ratteries->id]) ?>
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
