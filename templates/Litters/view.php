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
            <?php if (!is_null($user)) : ?>
                <div class="side-nav-group">
                    <?php if (! is_null($user) && $user->can('addRat', $litter)) : ?>
                        <div class="tooltip">
                            <?= $this->Html->image('/img/icon-add-rat.svg', [
                                'url' => ['controller' => 'Rats', 'action' => 'add', $litter->id],
                                'class' => 'side-nav-icon',
                                'alt' => __('Add rat')]) ?>
                            <span class="tooltiptext"><?= __('Add a rat in this litter') ?></span>
                        </div>
                    <?php else :?>
                        <div class="tooltip disabled">
                            <?= $this->Html->image('/img/icon-add-rat.svg', [
                                'url' => [],
                                'class' => 'side-nav-icon',
                                'alt' => __('Add rat')]) ?>
                            <span class="tooltiptext"><?= __('You cannot add a rat to this litter') ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (! is_null($user) && $user->can('manageContributions', $litter)) : ?>
                        <div class="tooltip">
                            <?= $this->Html->image('/img/icon-add-rattery.svg', [
                                'url' => ['controller' => 'Litters', 'action' => 'manageContributions', $litter->id],
                                'class' => 'side-nav-icon',
                                'alt' => __('Add rattery')]) ?>
                            <span class="tooltiptext"><?= __('Manage contributing ratteries') ?></span>
                        </div>
                    <?php else : ?>
                        <div class="tooltip disabled">
                            <?= $this->Html->image('/img/icon-add-rattery.svg', [
                                'url' => [],
                                'class' => 'side-nav-icon',
                                'alt' => __('Add rattery')]) ?>
                            <span class="tooltiptext"><?= __('You cannot manage contributing ratteries in this litter') ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (! is_null($user) && $user->can('editComment', $litter)) : ?>
                        <div class="tooltip">
                            <?= $this->Html->image('/img/icon-comment.svg', [
                                'url' => ['controller' => 'Litters', 'action' => 'editComment', $litter->id],
                                'class' => 'side-nav-icon',
                                'alt' => __('Edit Comment')]) ?>
                            <span class="tooltiptext"><?= __('Edit comment') ?></span>
                        </div>
                    <?php else :?>
                        <div class="tooltip disabled">
                            <?= $this->Html->image('/img/icon-comment.svg', [
                                'url' => [],
                                'class' => 'side-nav-icon',
                                'alt' => __('Edit Comment')]) ?>
                            <span class="tooltiptext"><?= __('You cannot edit the comment') ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (! is_null($user) && $user->can('ownerEdit', $litter)) : ?>
                        <div class="tooltip">
                            <?= $this->Html->image('/img/icon-edit.svg', [
                                'url' => ['controller' => 'Litters', 'action' => 'edit', $litter->id],
                                'class' => 'side-nav-icon',
                                'alt' => __('Edit litter')]) ?>
                            <span class="tooltiptext"><?= __('Edit this litter') ?></span>
                        </div>
                    <?php else :?>
                        <div class="tooltip disabled">
                            <?= $this->Html->image('/img/icon-edit.svg', [
                                'url' => [],
                                'class' => 'side-nav-icon',
                                'alt' => __('Edit litter')]) ?>
                            <span class="tooltiptext"><?= __('You cannot edit this litter') ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($user->is_staff) : ?>
                    <div class="side-nav-group">
                        <div class="tooltip">
                            <?= $this->Html->image('/img/icon-attach-rat.svg', [
                                'url' => ['controller' => 'Litters', 'action' => 'attachRat', $litter->id],
                                'class' => 'side-nav-icon',
                                'alt' => __('Add existing rat')]) ?>
                            <span class="tooltiptext"><?= __('Add an existing rat to this litter') ?></span>
                        </div>
                        <?= $this->element('staff_sidebar', [
                            'controller' => 'Litters',
                            'object' => $litter,
                            'user' => $user
                            ]) ?>
                    </div>
                <?php endif ;?>
            <?php endif ; ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litter') ?></div>
                <div class="sheet-markers">
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($litter->state->name) ?></span>
                    </div>
                </div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <?= $this->Flash->render() ?>

            <?php if ($litter->comments) : ?>
                <div class="text">
                    <blockquote>
                        <div class="markdown">
                            <?= $this->Commonmark->sanitize($litter->comments); ?>
                        </div>
                    </blockquote>
                </div>
            <?php endif; ?>

            <h2>Parents</h2>
            <div class="row">
                <div class="column-responsive column-50 parent">
                    <div class="pretitle"><?= __('Dam: ') . h($litter->dam[0]->name) ?></div>
                    <?php if ($litter->dam[0]->picture != '') : ?>
                        <?= $this->Html->image(UPLOADS . $litter->dam[0]->picture, ['alt' => $litter->dam[0]->pedigree_identifier, 'url' => ['controller' => 'Rats', 'action' => 'view', $litter->dam[0]->id]]) ?>
                    <?php else : ?>
                        <?= $this->Html->image('UnknownMother.png', ['alt' => $litter->dam[0]->pedigree_identifier, 'url' => ['controller' => 'Rats', 'action' => 'view', $litter->dam[0]->id]]) ?>
                    <?php endif; ?>
                    <p><?= h($litter->dam[0]->variety) ?><p>
                    <table class="caption" align="center">
                        <tr>
                            <th><?= __('Age at litter birth:') ?></th>
                            <td><?= h($litter->dam_age_in_months) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Reached age:') ?></th>
                            <td><?= h($litter->dam[0]->age_string) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Death cause:') ?></th>
                            <td><?= h($litter->dam[0]->main_death_cause) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="column-responsive column-50 parent">
                    <?php if (isset($litter->sire[0])) : ?>
                        <div class="pretitle"><?= __('Sire: ') . h($litter->sire[0]->name) ?></div>
                        <?php if ($litter->sire[0]->picture != '') : ?>
                            <?= $this->Html->image(UPLOADS . $litter->sire[0]->picture, ['alt' => $litter->sire[0]->pedigree_identifier, 'url' => ['controller' => 'Rats', 'action' => 'view', $litter->sire[0]->id]]) ?>
                        <?php else : ?>
                            <?= $this->Html->image('UnknownFather.png', ['alt' => $litter->dam[0]->pedigree_identifier, 'url' => ['controller' => 'Rats', 'action' => 'view', $litter->sire[0]->id]]) ?>
                        <?php endif; ?>
                        <p><?= h($litter->sire[0]->variety) ?><p>
                        <table class="caption" align="center">
                            <tr>
                                <th><?= __('Age at litter birth:') ?></th>
                                <td><?= h($litter->sire_age_in_months) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Reached age:') ?></th>
                                <td><?= h($litter->sire[0]->age_string) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Death cause:') ?></th>
                                <td><?= h($litter->sire[0]->main_death_cause) ?></td>
                            </tr>
                        </table>
                    <?php else : ?>
                        <div class="pretitle"><?= __('Sire: ') . __('Unknown') ?></div>
                        <?= $this->Html->image('UnknownFather.png', ['alt' => 'Unknown rat' ]) ?>
                        <p><?= __('Unknown') ?><p>
                        <table class="caption" align="center">
                            <tr>
                                <th><?= __('Age at litter birth:') ?></th>
                                <td><?= __('Unknown') ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Reached age:') ?></th>
                                <td><?= __('Unknown') ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Death cause:') ?></th>
                                <td><?= __('Unknown') ?></td>
                            </tr>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            <h2><?= __('Litter summary') ?></h2>
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
                        <?=  __('{0, plural, =0{No pup} =1{1 pup} other{# pups}}', [$this->Number->format($litter->pups_number)]) ?>
                        <?= __('(♀: {0} – ♂: {1} recorded)', [
                            ! empty($stats['sexes']) ? $this->Number->format($stats['sexes'][0]['F']) : '0',
                            ! empty($stats['sexes']) ? $this->Number->format($stats['sexes'][0]['M']) : '0'
                            ]
                        )?>
                    </tr>
                <tr>
                    <th><?= __('Stillborn pups') ?></th>
                    <td><?= $this->Number->format($litter->pups_number_stillborn) . ' ' . __('pups') ?></td>
                </tr>
                <tr>
                    <th><?= __('Inbreeding') ?></th>
                    <td><?= $this->Html->link('See inbreeding report', ['controller' => 'Litters', 'action' => 'inbreeding', $litter->id]) ?> </td>
                    </tr>
            </table>

            <h2><?= __('Ratteries') ?></h2>
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
                            <td><?= h($contribution->rattery->prefix) ?></td>
                            <td>
                                <?= $this->Html->link(
                                    h($contribution->rattery->name),
                                    ['controller' => 'Ratteries', 'action' => 'view', $contribution->rattery->id],
                                    ['escape' => false]
                                )?>
                            </td>
                            <td><?= h($contribution->contribution_type->name) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <h2><?= __('Offspring') ?></h2>
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

            <h2><?= __('Statistics') ?></h2>

            <?php if ($stats['survivors'] > 0) : ?>
                <div class="message warning">
                    <?= __('Lifespan is computed only on deceased rats. Please note that litter statistics will be accurate only after the last survivor’s death.') ?>
                </div>
            <?php endif; ?>

            <table class="condensed">
                <tr>
                    <th><?= __('Current survival rate:') ?></th>
                    <td>
                        <?= __('{0, number} %', [$this->Number->format($stats['survivors'])]) ?>
                    <span class="comment">
                        <?= $stats['survivors'] == 0 ?
                        __('(all rats of the litter are now dead, or supposed so)') :
                        '(at ' . $stats['max_age'] . ')'
                         ?>
                    </span>
                    </td>
                </tr>
            </table>
            <table class="condensed">
                <tr>
                    <th><?= __('Average lifespan:') ?></th>
                    <td><?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['lifespan'], $stats['female_lifespan'], $stats['male_lifespan']]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('infant mortality excluded:') ?></th>
                    <td> ⨽ <?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['not_infant_lifespan'], $stats['female_not_infant_lifespan'], $stats['male_not_infant_lifespan']]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('accidents excluded:') ?></th>
                    <td> ⨽ <?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [$stats['not_accident_lifespan'], $stats['female_not_accident_lifespan'], $stats['male_not_accident_lifespan']]) ?></td>
                </tr>
            </table>

            <canvas id="mortality-chart"></canvas>

            <div class="signature">
                &mdash; <?= __('Created on {0} by {1}.', [$litter->created->i18nFormat('dd/MM/yyyy'), $litter->user->username]) ?>  <?= ($litter->modified != $litter->created) ? __('Last modified on {0}.', [$litter->modified->i18nFormat('dd/MM/yyyy')]) : '' ?>
            </div>
        </div>

        <?php if (! is_null($user) && $user->can('changeState', $litter)) : ?>
            <?= $this->element('statebar', ['sheet' => $litter]) ?>
        <?php endif ; ?>

        <?php if (! is_null($user) && $user->can('seePrivate', $litter)) : ?>
            <div class="spacer"> </div>
            <div class="content litter view">
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
                <div class="related">
                    <details>
                        <summary class="staff">
                            <?= __('Snapshots') ?>
                        </summary>
                    <?php if (!empty($litter->litter_snapshots)) : ?>
                        <div class="table-responsive">
                            <table class="summary">
                                <thead>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Differences') ?></th>
                                    <th><?= __('State') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </thead>
                                <?php foreach ($litter->litter_snapshots as $litterSnapshots) : ?>
                                <tr>
                                    <td><?= h($litterSnapshots->created) ?></td>
                                    <td><?= h($snap_diffs[$litterSnapshots->id]) ?></td>
                                    <td><?= h($litterSnapshots->state->symbol) ?></td>
                                    <td class="actions">
                                        <span class="nowrap">
                                            <?= $this->Html->image('/img/icon-view.svg', [
                                                'url' => ['controller' => 'LitterSnapshots', 'action' => 'view', $litterSnapshots->id],
                                                'class' => 'action-icon',
                                                'alt' => __('View Snapshot')]) ?>
                                            <?= $this->Html->image('/img/icon-restore.svg', [
                                                'url' => ['controller' => 'Litters', 'action' => 'restore', $litter->id, $litterSnapshots->id],
                                                'class' => 'action-icon',
                                                'alt' => __('Restore Snapshot')]) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <?php endif; ?>
                    </details>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js') ?>
<script>
    Chart.defaults.font.family = "Imprima";
    Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(102,51,0,1)';
    Chart.defaults.plugins.tooltip.position = 'nearest';

    var jsLegends = <?php echo $js_legends; ?>;

    var survival_json = <?php echo json_encode($stats['survival']); ?>;
    var survival_data = survival_json.map(function(e) {
      return e.count;
    });
    var survival_labels = survival_json.map(function(e) {
      return e.months;
    });

    var mortality_ctx = document.getElementById('mortality-chart').getContext('2d');
    var mortality_config = {
      data: {
          labels: survival_labels,
          datasets: [
              {
                  type: 'line',
                  label: jsLegends['0'], // 'Survival rate'
                  data: survival_data,
                  backgroundColor: 'rgba(61, 75, 153, 1)',
                  borderColor: 'rgba(61, 75, 153, 1)',
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
                  xAxisID: 'xtrunc',
                  yAxisID: 'yleft',
                  stepped: true
              }
          ],
      },
      options: {
          aspectRatio:2.5,
          responsive: true,
          interaction: {
              mode: 'index',
              intersect: false,
          },
          stacked: false,
          scales: {
              xtrunc: {
                  display: true,
                  position: 'bottom',
                  max: 48,
                  suggestedMax: 48,
                  ticks: {
                      beginAtZero:true,
                      stepSize: 1,
                      min: 0,
                      max: 48,
                      suggestedMax: 48,
                  },
                  title: {
                      display: true,
                      text: jsLegends['1'], // 'Age (in months)'
                      font: {
                          weight: 700
                      }
                  }
              },
              yleft: {
                  type: 'linear',
                  display: true,
                  offset: false,
                  position: 'left',
                  suggestedMin: 0,
                  //max: 102,
                  ticks: {
                      beginAtZero:true,
                      min: 0,
                      max: 100
                  },
                  title: {
                      display: true,
                      text: jsLegends['2'], //'Survival rate (%)',
                      color: 'rgba(61, 75, 153, 1)',
                      font: {
                          weight: 700
                      }
                  }
              }
          },
          plugins: {
              legend: {
                  display: false,
              },
              title: {
                   display: true,
                   text: jsLegends['3'], //'Survival rate by age'
              },
              tooltip: {
                  caretPadding: 6,
                  xAlign: 'center',
                  yAlign: 'bottom',
                  position: 'nearest',
                  displayColors: true,
                  callbacks: {
                      label: function(context) {
                          var label = context.dataset.label || '';
                          if (label) {
                              label += ': ';
                          }
                          if (context.datasetIndex === 0) {
                              label += Math.round(100*context.parsed.y)/100 + jsLegends['4']; //' % of litter pups reached this age'
                          }
                          return label;
                      },
                      title: function(context) {
                          // var title = 'Age: between ' + context[0].label + ' and ' + (parseInt(context[0].label)+1).toString() + ' months';
                          var title = jsLegends['5'] + context[0].label + jsLegends['6'] + (parseInt(context[0].label)+1).toString() + jsLegends['7'];
                          return title;
                      }
                  }
              }
          }
      }
    };
    var mortality_chart = new Chart(mortality_ctx, mortality_config);
</script>
