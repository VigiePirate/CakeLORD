<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-fa-alert.svg', [
          'url' => ['controller' => 'Conversations', 'action' => 'add'],
          'class' => 'side-nav-icon',
          'alt' => __('Report')]) ?>
      <?= $this->Html->image('/img/icon-help.svg', [
              'url' => ['controller' => 'Articles', 'action' => 'index'],
              'class' => 'side-nav-icon',
              'alt' => __('Help')]) ?>
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
            </div>
            <h1><?= h($state->name) ?></h1>
            <h2><?= __('Information') ?></h2>
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
            <h2><?= __('Related entries') ?></h2>
            <div class="related">
                <h3><?= __('Related Litter Snapshots') ?></h3>
                <?php if (!empty($state->litter_snapshots)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->litter_snapshots as $litterSnapshots) : ?>
                        <tr>
                            <td><?= h($litterSnapshots->id) ?></td>
                            <td><?= h($litterSnapshots->data) ?></td>
                            <td><?= h($litterSnapshots->litter_id) ?></td>
                            <td><?= h($litterSnapshots->state_id) ?></td>
                            <td><?= h($litterSnapshots->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'LitterSnapshots', 'action' => 'view', $litterSnapshots->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'LitterSnapshots', 'action' => 'edit', $litterSnapshots->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'LitterSnapshots', 'action' => 'delete', $litterSnapshots->id], ['confirm' => __('Are you sure you want to delete # {0}?', $litterSnapshots->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?= __('Related Litters') ?></h3>
                <?php if (!empty($state->litters)) : ?>
                <div class="table-responsive">
                    <table class="summary"> <!-- to be replaced by a litter element later, or a button to a search result -->
                        <thead>
                            <tr>
                                <th></th>
                                <th><?= $this->Paginator->sort('birth_date') ?></th>
                                <th><?= $this->Paginator->sort('dam') ?></th>
                                <th><?= $this->Paginator->sort('sire') ?></th>
                                <th><?= $this->Paginator->sort('size') ?></th>
                                <th class="actions"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($state->litters as $litter): ?>
                            <tr>
                                <td><span class="statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></span></td>
                                <td><?= $litter->has('birth_date') ? h($litter->birth_date->i18nFormat('dd/MM/yyyy')) : __('Unknown date') ?></td>
                                <td><?= !empty($litter->dam) ? h($litter->dam[0]->usual_name) : __('Unknown') ?></td>
                                <td><?= !empty($litter->sire) ? h($litter->sire[0]->usual_name) : __('Unknown') ?></td>
                                <td><?= $this->Number->format($litter->pups_number) ?></td>
                                <td class="actions">
                                    <?= $this->Html->image('/img/icon-fa-eye.svg', [
                                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                                        'class' => 'action-icon',
                                        'alt' => __('See Litter')]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?= __('Related Rat Snapshots') ?></h3>
                <?php if (!empty($state->rat_snapshots)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Rat Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->rat_snapshots as $ratSnapshots) : ?>
                        <tr>
                            <td><?= h($ratSnapshots->id) ?></td>
                            <td><?= h($ratSnapshots->data) ?></td>
                            <td><?= h($ratSnapshots->rat_id) ?></td>
                            <td><?= h($ratSnapshots->state_id) ?></td>
                            <td><?= h($ratSnapshots->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RatSnapshots', 'action' => 'view', $ratSnapshots->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RatSnapshots', 'action' => 'edit', $ratSnapshots->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RatSnapshots', 'action' => 'delete', $ratSnapshots->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratSnapshots->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?= __('Related Rats') ?></h3>
                <?php if (!empty($state->rats)) : ?>
                <div class="table-responsive">
                    <?= $this->element('simple_rats', [ //rats
                        'rubric' => __(''),
                        'rats' => $state->rats,
                        'exceptions' => [
                            'picture',
                            'pup_name',
                        ],
                    ]) ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?= __('Related Ratteries') ?></h3>
                <?php if (!empty($state->ratteries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Prefix') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Birth Year') ?></th>
                            <th><?= __('Is Alive') ?></th>
                            <th><?= __('Is Generic') ?></th>
                            <th><?= __('District') ?></th>
                            <th><?= __('Zip Code') ?></th>
                            <th><?= __('Country Id') ?></th>
                            <th><?= __('Website') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Wants Statistic') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->ratteries as $ratteries) : ?>
                        <tr>
                            <td><?= h($ratteries->id) ?></td>
                            <td><?= h($ratteries->prefix) ?></td>
                            <td><?= h($ratteries->name) ?></td>
                            <td><?= h($ratteries->owner_user_id) ?></td>
                            <td><?= h($ratteries->birth_year) ?></td>
                            <td><?= h($ratteries->is_alive) ?></td>
                            <td><?= h($ratteries->is_generic) ?></td>
                            <td><?= h($ratteries->district) ?></td>
                            <td><?= h($ratteries->zip_code) ?></td>
                            <td><?= h($ratteries->country_id) ?></td>
                            <td><?= h($ratteries->website) ?></td>
                            <td><?= h($ratteries->comments) ?></td>
                            <td><?= h($ratteries->wants_statistic) ?></td>
                            <td><?= h($ratteries->picture) ?></td>
                            <td><?= h($ratteries->state_id) ?></td>
                            <td><?= h($ratteries->created) ?></td>
                            <td><?= h($ratteries->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Ratteries', 'action' => 'view', $ratteries->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Ratteries', 'action' => 'edit', $ratteries->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ratteries', 'action' => 'delete', $ratteries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratteries->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?= __('Related Rattery Snapshots') ?></h3>
                <?php if (!empty($state->rattery_snapshots)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($state->rattery_snapshots as $ratterySnapshots) : ?>
                        <tr>
                            <td><?= h($ratterySnapshots->id) ?></td>
                            <td><?= h($ratterySnapshots->data) ?></td>
                            <td><?= h($ratterySnapshots->rattery_id) ?></td>
                            <td><?= h($ratterySnapshots->state_id) ?></td>
                            <td><?= h($ratterySnapshots->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RatterySnapshots', 'action' => 'view', $ratterySnapshots->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RatterySnapshots', 'action' => 'edit', $ratterySnapshots->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'RatterySnapshots', 'action' => 'delete', $ratterySnapshots->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratterySnapshots->id)]) ?>
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
