<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-edit.svg', [
                        'url' => ['controller' => 'Litters', 'action' => 'edit'],
                        'class' => 'side-nav-icon',
                        'alt' => __('Edit litter')]) ?>
                    <span class="tooltiptext"><?= __('Edit this litter') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-add-rattery.svg', [
                        'url' => ['controller' => 'Litters', 'action' => 'add_contribution'],
                        'class' => 'side-nav-icon',
                        'alt' => __('Add rattery')]) ?>
                    <span class="tooltiptext"><?= __('Add a contributing rattery') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-add-rat.svg', [
                        'url' => ['controller' => 'Rats', 'action' => 'add'],
                        'class' => 'side-nav-icon',
                        'alt' => __('Add rat')]) ?>
                    <span class="tooltiptext"><?= __('Add a rat in this litter') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Litters',
                    'object' => $litter
                    ]) ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litter') ?></div>
                <?= $this->element('statebar', ['sheet' => $litter]) ?>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <?php if ($litter->comments) : ?>
                <div class="text">
                    <blockquote>
                        <?= $this->Text->autoParagraph(h($litter->comments)); ?>
                    </blockquote>
                </div>
            <?php endif; ?>

            <h2>Parents</h2>
            <div class="row">
                <div class="column-responsive column-50 parent">
                    <div class="pretitle"><?= __('Dam: ') . h($litter->dam[0]->name) ?></div>
                    <?php if ($litter->dam[0]->picture != '') : ?>
                        <?= $this->Html->image('uploads/' . $litter->dam[0]->picture, ['alt' => $litter->dam[0]->pedigree_identifier, 'url' => ['controller' => 'Rats', 'action' => 'view', $litter->dam[0]->id]]) ?>
                    <?php else : ?>
                        <?= $this->Html->image('UnknownMother.png', ['alt' => $litter->dam[0]->pedigree_identifier, 'url' => ['controller' => 'Rats', 'action' => 'view', $litter->dam[0]->id]]) ?>
                    <?php endif; ?>
                    <p><?= h($litter->dam[0]->variety) ?><p>
                    <table class="caption" align="center">
                        <tr>
                            <th>Age at litter birth:</th>
                            <td><?= h($litter->dam_age) ?></td>
                        </tr>
                        <tr>
                            <th>Reached age:</th>
                            <td><?= h($litter->dam[0]->age_string) ?></td>
                        </tr>
                        <tr>
                            <th>Death cause:</th>
                            <td><?= h($litter->dam[0]->main_death_cause) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="column-responsive column-50 parent">
                    <?php if (isset($litter->sire[0])) : ?>
                        <div class="pretitle"><?= __('Sire: ') . h($litter->sire[0]->name) ?></div>
                        <?php if ($litter->sire[0]->picture != '') : ?>
                            <?= $this->Html->image('uploads/' . $litter->sire[0]->picture, ['alt' => $litter->sire[0]->pedigree_identifier, 'url' => ['controller' => 'Rats', 'action' => 'view', $litter->sire[0]->id]]) ?>
                        <?php else : ?>
                            <?= $this->Html->image('UnknownFather.png', ['alt' => $litter->dam[0]->pedigree_identifier, 'url' => ['controller' => 'Rats', 'action' => 'view', $litter->sire[0]->id]]) ?>
                        <?php endif; ?>
                        <p><?= h($litter->sire[0]->variety) ?><p>
                        <table class="caption" align="center">
                            <tr>
                                <th>Age at litter birth:</th>
                                <td><?= h($litter->sire_age) ?></td>
                            </tr>
                            <tr>
                                <th>Reached age:</th>
                                <td><?= h($litter->sire[0]->age_string) ?></td>
                            </tr>
                            <tr>
                                <th>Death cause:</th>
                                <td><?= h($litter->sire[0]->main_death_cause) ?></td>
                            </tr>
                        </table>
                    <?php else : ?>
                        <div class="pretitle"><?= __('Sire: ') . __('Unknown') ?></div>
                        <?= $this->Html->image('UnknownFather.png', ['alt' => 'Unknown rat' ]) ?>
                        <p><?= __('Unknown') ?><p>
                        <table class="caption" align="center">
                            <tr>
                                <th>Age at litter birth:</th>
                                <td><?= __('Unknown') ?></td>
                            </tr>
                            <tr>
                                <th>Reached age:</th>
                                <td><?= __('Unknown') ?></td>
                            </tr>
                            <tr>
                                <th>Death cause:</th>
                                <td><?= __('Unknown') ?></td>
                            </tr>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            <h2>Litter summary</h2>
            <table class="condensed">
                <tr>
                    <th><?= __('Prefix') ?></th>
                    <td><?= $litter->contributions[0]->rattery->prefix ?><?= !empty($litter->contributions[1]) ? ('-' . $litter->contributions[1]->rattery->prefix) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Mating date') ?></th>
                    <td><?= isset($litter->mating_date) ? h($litter->mating_date->i18nFormat('dd/MM/yyyy')) : __('Unknown') ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth date') ?></th>
                    <td><?= h($litter->birth_date->i18nFormat('dd/MM/yyyy')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pups number') ?></th>
                    <td>
                        <?= $this->Number->format($litter->pups_number) . ' ' . __('pups')?>
                        (♀: <?= $this->Number->format($sexes[0]['F']) ?>,
                        ♂: <?= $this->Number->format($sexes[0]['M']) ?>)</td>
                </tr>
                <tr>
                    <th><?= __('Stillborn pups number') ?></th>
                    <td><?= $this->Number->format($litter->pups_number_stillborn) ?></td>
                </tr>
            </table>

            <h2>Ratteries</h2>
            <?php if (!empty($litter->contributions)) : ?>
            <div class="table-responsive">
                <table class="condensed">
                    <thead>
                        <tr>
                            <th><?= __('Rattery Prefix') ?></th>
                            <th><?= __('Rattery Name') ?></th>
                            <th><?= __('Contribution') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($litter->contributions as $contribution) : ?>
                        <tr>
                            <td><?= $this->Html->link(h($contribution->rattery->prefix), ['controller' => 'Ratteries', 'action' => 'view', $contribution->rattery->id]) ?></td>
                            <td><?= h($contribution->rattery->name) ?></td>
                            <td><?= h($contribution->contribution_type->name) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <h2>Offspring</h2>
            <?php if (!empty($litter->offspring_rats)) : ?>
                <?= $this->element('simple_rats', [
                    'rubric' => '',
                    'rats' => $offsprings,
                    'exceptions' => [
                        'picture',
                        'prefix',
                        'birth_date',
                        'paginator',
                    ],
                ]) ?>
            <?php endif; ?>

            <h2>Statistics</h2>
            <table class="condensed">
                <tr>
                    <th><?= __('Survival rate') ?></th>
                    <td>(not available yet)</td>
                </tr>
                <tr>
                    <th><?= __('Average Lifespan') ?></th>
                    <td>(not available yet)</td>
                </tr>
            </table>

            <div class="spacer"> </div>
            <h2 class="staff"><?= __('Private information') ?></h2>
            <div class="related staff">
                <h3 class="staff"><?= __('Related Conversations') ?></h3>
                <?php if (!empty($litter->conversations)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Rat Id') ?></th>
                            <th><?= __('Rattery Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($litter->conversations as $conversations) : ?>
                        <tr>
                            <td><?= h($conversations->id) ?></td>
                            <td><?= h($conversations->rat_id) ?></td>
                            <td><?= h($conversations->rattery_id) ?></td>
                            <td><?= h($conversations->litter_id) ?></td>
                            <td><?= h($conversations->created) ?></td>
                            <td><?= h($conversations->modified) ?></td>
                            <td><?= h($conversations->is_active) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Conversations', 'action' => 'view', $conversations->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Conversations', 'action' => 'edit', $conversations->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Conversations', 'action' => 'delete', $conversations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conversations->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related staff">
                <h3 class="staff"><?= __('Related Litter Snapshots') ?></h3>
                <?php if (!empty($litter->litter_snapshots)) : ?>
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
                        <?php foreach ($litter->litter_snapshots as $litterSnapshots) : ?>
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
            <div class="signature">
                &mdash; Created on <?= $litter->created->i18nFormat('dd/MM/yyyy') ?> by <?= $litter->user->username ?>. <?= ($litter->modified != $litter->created) ? 'Last modified on ' . $litter->modified->i18nFormat('dd/MM/yyyy') .'.' : '' ?>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
