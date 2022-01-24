<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Rattery $rattery
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
                        'url' => ['controller' => 'Ratteries', 'action' => 'edit', $rattery->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Modify Rattery')]) ?>
                    <span class="tooltiptext"><?= __('Edit whole rattery sheet') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-locate.svg', [
                        'url' => ['controller' => 'Ratteries', 'action' => 'locate', $rattery->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('See on Map')]) ?>
                    <span class="tooltiptext"><?= __('See rattery on the map') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-relocate.svg', [
                        'url' => ['controller' => 'Ratteries', 'action' => 'relocate', $rattery->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Move')]) ?>
                    <span class="tooltiptext"><?= __('Declare a new location') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-add-litter.svg', [
                        'url' => ['controller' => 'Litters', 'action' => 'add'], //pass rattery id as contributor ? $rattery->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Declare Litter')]) ?>
                    <span class="tooltiptext"><?= __('Declare a litter born here') ?></span>
                </div>
            </div>

            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Ratteries',
                    'object' => $rattery
                    ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= $rattery->is_generic ? __('Generic origin') :  __('Rattery') ?></div>
                <?= $this->element('statebar', ['sheet' => $rattery]) ?>
            </div>

            <h1><?= h($rattery->full_name) . '<span class="rotate"> ' . h($rattery->is_inactive_symbol) . '</span>'?></h1> <!-- -->

            <?php if($rattery->is_generic) : ?>
                <div class="message"><?= __('This is a generic prefix. It does not correspond to an actual rattery. Therefore, only limited information is shown.') ?></div>
                <h2><?= __('Statistics') ?></h2>
                <h3>Breeding statistics</h3>
                <table class="condensed stats">
                    <tr>
                        <th>Litters recorded under this prefix:</th>
                        <td><?= h($stats['inLitterCount']) ?> litter<?= h($stats['inLitterCount']<2) ? '' : 's' ?></td>
                    </tr>
                    <tr>
                        <th>Rats recorded under this prefix:</th>
                        <td><?= h($stats['ratCount']) ?> rats</td>
                    </tr>
                    <tr>
                        <th> ⨽ females:</th>
                        <td> ⨽ <?= h($stats['femaleCount']) . ' females (' . h($stats['femaleProportion']) .' %)' ?></td>
                    </tr>
                    <tr>
                        <th> ⨽ males:</th>
                        <td> ⨽ <?= h($stats['maleCount']) . ' males (' . h($stats['maleProportion']) .' %)' ?></td>
                    </tr>
                </table>

                <h3>Lifespan statistics</h3>
                <?php if($stats['ratCount'] == 0 && $stats['outRatCount'] > 0) : ?>
                    <div class="message">This prefix is only used in external litters.</div>
                <?php else : ?>
                    <?php if ($stats['ratCount'] == 0 && $stats['outRatCount'] == 0) : ?>
                        <div class="message error">No recorded rat is associated with this origin.</div>
                    <?php else : ?>
                        <table class="condensed stats">
                            <tr>
                                <th>Rats recorded as deceased:</th>
                                <td><?= h($stats['presumedDeadRatCount']) ?> rat<?= h($stats['presumedDeadRatCount']<2) ? '' : 's' ?> (<?= h($stats['deadRatProportion']) ?> % of recorded rats)</td>
                            </tr>
                            <tr>
                                <th> ⨽ declared with known date:</th>
                                <td> ⨽ <?= h($stats['deadRatCount']) ?> rat<?= h($stats['deadRatCount']<2) ? '' : 's' ?> (<?= h($stats['followedRatProportion']) ?> %)</td>
                            </tr>
                            <tr>
                                <th> ⨽ presumed dead:</th>
                                <td> ⨽ <?= h($stats['lostRatCount']) ?> rat<?= h($stats['lostRatCount']<2) ? '' : 's' ?> (<?= h($stats['lostRatProportion']) ?> %)</td>
                            </tr>
                        </table>
                        <?php if ($stats['deadRatCount'] > 9) : ?>
                            <table class="condensed stats">
                                <tr>
                                    <th>Average lifespan of rats with this prefix:</th>
                                    <td><?= h($stats['deadRatAge']) ?> months (♀: <?= h($stats['deadFemaleAge']) ?>, ♂: <?= h($stats['deadMaleAge']) ?>)</td>
                                </tr>
                                <tr>
                                    <th> ⨽ infant mortality excluded:</th>
                                    <td> ⨽ <?= h($stats['deadRatAgeAdult']) ?> months (♀: <?= h($stats['deadFemaleAgeAdult']) ?>, ♂: <?= h($stats['deadMaleAgeAdult']) ?>)</td>
                                </tr>
                                <tr>
                                    <th> ⨽ accidents excluded:</th>
                                    <td> ⨽ <?= h($stats['deadRatAgeHealthy']) ?> months (♀: <?= h($stats['deadFemaleAgeHealthy']) ?>, ♂: <?= h($stats['deadMaleAgeHealthy']) ?>)</td>
                                </tr>
                            </table>
                        <?php else : ?>
                            <div class="message">There aren't enough rats with consolidated information to compute relevant mortality statistics.</div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

            <?php else : ?> <!-- non generic rattery -->

                <h2>Information</h2>
                <div class="row">
                    <?php if ($rattery->picture != '') : ?>
                        <div class="column-responsive column-66">
                    <?php else : ?>
                        <div class="column-responsive column-100">
                    <?php endif; ?>
                    <table class="condensed stats">
                        <tr>
                            <!-- add user first and last name if not anonymous ? -->
                            <th><?= __('Owner') ?></th>
                            <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->username, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Founded in') ?></th>
                            <td><?= ($rattery->birth_year != '0000') ? h($rattery->birth_year) : h(substr($stats['activityYears'],0,4)) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Country') ?></th>
                            <td><?= $rattery->has('country') ? h($rattery->country->name) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Localization') ?></th>
                            <td><?= h($rattery->district) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Zip Code') ?></th>
                            <td><?= h($rattery->zip_code) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Latitude (debug)') ?></th>
                            <td><?= h($rattery->lat) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Longitude (debug)') ?></th>
                            <td><?= h($rattery->lng) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Website') ?></th>
                            <td><?= $rattery->website ? $this->Html->link(h($rattery->website)) : '' ?></td>
                        </tr>
                    </table>

                    </div>
                    <?php if ($rattery->picture != '') : ?>
                        <div class="column">
                            <?= $this->Html->image('uploads/' . $rattery->picture, ['alt' => $rattery->prefix]) ?>
                        </div>
                    <?php endif ?>
                </div>

                <?php if (! empty($rattery->comments)) : ?>
                    <div class="text">
                        <blockquote>
                            <?= $this->Text->autoParagraph(h($rattery->comments)); ?>
                        </blockquote>
                    </div>
                <?php endif; ?>

                <h2><?= __('Statistics') ?></h2>
                <?php if ($stats['ratCount'] == 0 && $stats['outRatCount'] == 0) : ?>
                    <div class="message error">No recorded rat was born in (or in partnership with) this rattery.</div>
                <?php else : ?>
                    <details open>
                        <summary>Breeding statistics</summary>
                        <table class="condensed stats">
                            <tr>
                                <th>Breeding activity period:</th>
                                <td><?= h($stats['activityYears']) ?></td>
                            </tr>
                        </table>
                        <table class="condensed stats">
                            <tr>
                                <th>Total breeding activity:</th>
                                <td><?= h($stats['inLitterCount']+$stats['outLitterCount']) ?> litter<?= ($stats['inLitterCount']+$stats['outLitterCount'])<2 ? '' : 's' ?>,
                                    <?= h($stats['inRatCount']+$stats['outRatCount']) ?> pup<?= ($stats['inRatCount']+$stats['outRatCount'])<2 ? '' : 's' ?></td>
                            </tr>
                            <tr>
                                <th> ⨽ internal (born in the rattery):</th>
                                <td> ⨽ <?= h($stats['inLitterCount']) ?> litter<?= h($stats['inLitterCount']<2) ? '' : 's' ?>, <?= h($stats['inRatCount']) ?> pup<?= h($stats['inRatCount']<2) ? '' : 's' ?></td>
                            </tr>
                            <tr>
                                <th> ⨽ external (other contributed litters):</th>
                                <td> ⨽ <?= h($stats['outLitterCount']) ?> litter<?= h($stats['outLitterCount']<2) ? '' : 's' ?>, <?= h($stats['outRatCount']) ?> pup<?= h($stats['outRatCount']<2) ? '' : 's' ?><!--, with xx different partner ratteries--></td>
                            </tr>
                        </table>
                        <table class="condensed stats">
                            <tr>
                                <th>Rat records (born in the rattery):</th>
                                <td><?= h($stats['ratCount']) ?> rat<?= h($stats['ratCount']<2) ? '' : 's' ?></td>
                            </tr>
                            <tr>
                                <th> ⨽ females:</th>
                                <td> ⨽ <?= h($stats['femaleCount']) . ' female'. (h($stats['femaleCount']<2) ? '' : 's') . ' (' . h($stats['femaleProportion']) .' %)' ?></td>
                            </tr>
                            <tr>
                                <th> ⨽ males:</th>
                                <td> ⨽ <?= h($stats['maleCount']) . ' male'. (h($stats['maleCount']<2) ? '' : 's') . ' (' . h($stats['maleProportion']) .' %)' ?></td>
                            </tr>
                        </table>
                    </details>

                    <?php if($rattery->wants_statistic) : ?>
                        <details>
                            <summary>More breeding statistics</summary>
                            <table class="condensed stats">
                                <tr>
                                    <th><?= __('Average mother age:') ?></th>
                                    <td><?= h(round($stats['avg_mother_age'])) ?> days (<?= h(round($stats['avg_mother_age']/30.5,1)) ?> months)</td>
                                </tr>
                                <tr>
                                    <th><?= __('Average father age:') ?></th>
                                    <td><?= ($stats['avg_father_age'] != 0) ?
                                        h(round($stats['avg_father_age'])) . __(' days (') . h(round($stats['avg_father_age']/30.5,1)) . __(' months)') :
                                        __('This rattery only had litters of unknown fathers')
                                        ?> </td>
                                </tr>
                                <tr>
                                    <th><?= __('Average litter size:') ?></th>
                                    <td><?= h($stats['avg_litter_size']) ?> pups</td>
                                </tr>
                                <tr>
                                    <th><?= __('Average sex ratio:') ?></th>
                                    <td><?= h($stats['avg_sex_ratio']) ?></td>
                                </tr>
                            </table>
                        </details>

                        <?php if($stats['ratCount'] == 0 && $stats['outRatCount'] > 0) : ?>
                            <div class="message">This rattery only had external litters. Mortality statistics can be consulted on each of their contributed litter sheets. </div>
                        <?php else : ?>
                            <?php if ($stats['deadRatCount'] > 9) : ?>
                                <details open>
                                    <summary>Lifespan statistics</summary>
                                    <table class="condensed stats">
                                        <tr>
                                            <th>Bred rats recorded as deceased:</th>
                                            <td><?= h($stats['presumedDeadRatCount']) ?> rat<?= h($stats['presumedDeadRatCount']<2) ? '' : 's' ?> (<?= h($stats['deadRatProportion']) ?> % of recorded bred rats)</td>
                                        </tr>
                                        <tr>
                                            <th> ⨽ declared with known date:</th>
                                            <td> ⨽ <?= h($stats['deadRatCount']) ?> rat<?= h($stats['deadRatCount']<2) ? '' : 's' ?> (<?= h($stats['followedRatProportion']) ?> %)</td>
                                        </tr>
                                        <tr>
                                            <th> ⨽ presumed dead:</th>
                                            <td> ⨽ <?= h($stats['lostRatCount']) ?> rat<?= h($stats['lostRatCount']<2) ? '' : 's' ?> (<?= h($stats['lostRatProportion']) ?> %)</td>
                                        </tr>
                                    </table>
                                    <table class="condensed stats">
                                        <tr>
                                            <th>Average lifespan of bred rats:</th>
                                            <td><?= h($stats['deadRatAge']) ?> months (♀: <?= h($stats['deadFemaleAge']) ?>, ♂: <?= h($stats['deadMaleAge']) ?>)</td>
                                        </tr>
                                        <tr>
                                            <th> ⨽ infant mortality excluded:</th>
                                            <td> ⨽ <?= h($stats['deadRatAgeAdult']) ?> months (♀: <?= h($stats['deadFemaleAgeAdult']) ?>, ♂: <?= h($stats['deadMaleAgeAdult']) ?>)</td>
                                        </tr>
                                        <tr>
                                            <th> ⨽ accidents excluded:</th>
                                            <td> ⨽ <?= h($stats['deadRatAgeHealthy']) ?> months (♀: <?= h($stats['deadFemaleAgeHealthy']) ?>, ♂: <?= h($stats['deadMaleAgeHealthy']) ?>)</td>
                                        </tr>
                                    </table>
                                    <table class="condensed stats">
                                        <tr>
                                            <th>Oldest bred rat:</th>
                                            <td><?= ! is_null($champion) ?
                                                $this->Html->link(h($champion->usual_name),['controller' => 'Rats', 'action' => 'view', $champion->id]) . __(' (deceased at ') . h($champion->champion_age_string) . ')' :
                                                __('No eligible champion')
                                            ?></td>
                                        </tr>
                                    </table>
                                </details>

                                <details>
                                    <summary>Death causes statistics</summary>
                                    <table class="condensed stats">
                                        <tr>
                                            <th>Primary death causes by decreasing frequency:</th>
                                        </tr>
                                    </table>
                                    <table class="condensed stats histogram">
                                        <?php foreach($stats['primaries'] as $category): ?>
                                            <tr>
                                                <th>
                                                    <div style="opacity:<?= h(0.25+0.75*$category['count']/$stats['primaries'][0]['count']) ?>; width:<?= h($category['count']/$stats['primaries'][0]['count']*100) ?>%">
                                                        <?= h(round($category['count']/$stats['deadRatCount']*100,2)) ?> %
                                                    </div>
                                                </th>
                                                <td><?= h($category['name']) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>
                                    <table class="condensed stats">
                                        <tr>
                                            <th>Secondary death causes by decreasing frequency:</th>
                                        </tr>
                                    </table>
                                    <table class="condensed stats histogram">
                                        <?php foreach($stats['secondaries'] as $cause): ?>
                                            <tr>
                                                <th>
                                                    <div style="opacity:<?= h(0.25+0.75*$cause['count']/$stats['secondaries'][0]['count']) ?>; width:<?= h($cause['count']/$stats['secondaries'][0]['count']*100) ?>%">
                                                        <?= h(round($cause['count']/$stats['deadRatCount']*100,2)) ?> %
                                                    </div>
                                                </th>
                                                <td><?= h($cause['name']) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>
                                </details>

                            <?php else : ?>
                                <details open>
                                    <summary>Lifespan statistics</summary>
                                    <table class="condensed stats">
                                        <tr>
                                            <th>Bred rats recorded as deceased:</th>
                                            <td><?= h($stats['presumedDeadRatCount']) ?> rat<?= h($stats['presumedDeadRatCount']<2) ? '' : 's' ?> (<?= h($stats['deadRatProportion']) ?> % of recorded bred rats)</td>
                                        </tr>
                                        <tr>
                                            <th> ⨽ declared with known date:</th>
                                            <td> ⨽ <?= h($stats['deadRatCount']) ?> rat<?= h($stats['deadRatCount']<2) ? '' : 's' ?> (<?= h($stats['followedRatProportion']) ?> %)</td>
                                        </tr>
                                        <tr>
                                            <th> ⨽ presumed dead:</th>
                                            <td> ⨽ <?= h($stats['lostRatCount']) ?> rat<?= h($stats['lostRatCount']<2) ? '' : 's' ?> (<?= h($stats['lostRatProportion']) ?> %)</td>
                                        </tr>
                                    </table>
                                </details>
                                <div class="message">There aren't enough rats with consolidated information to compute relevant mortality statistics.</div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else : ?> <!-- treat ratteries not wanting statistics -->
                        <div class="message warning">The owner of this rattery does not wish to show their full breeding and mortality statistics.</div>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
            <div class="spacer"> </div>
            <div class="ratteries view content">
                <div class="row">
                    <div class="column-responsive column-33">
                        <h2>Related entries</h2>
                    </div>
                    <div class="column-responsive column-66">
                        <?= $this->Html->link(__('See all bred rats'), ['controller' => 'Rats', 'action' => 'fromRattery', $rattery->prefix], ['class' => 'button float-right']) ?>
                        <?= $this->Html->link(__('See all contributed litters'), ['controller' => 'Contributions', 'action' => 'fromRattery', $rattery->id], ['class' => 'button float-right']) ?>
                    </div>
                </div>

                <details open>
                    <summary>Last contributed litters</summary>
                    <table class="summary">
                        <thead>
                            <tr>
                                <th><?= __('State') ?></th>
                                <th><?= $this->Paginator->sort('birth_date') ?></th>
                                <th><?= $this->Paginator->sort('dam') ?></th>
                                <th><?= $this->Paginator->sort('sire') ?></th>
                                <th><?= $this->Paginator->sort('size') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($rattery->litters,0,10) as $litter): ?>
                            <tr>
                                <td><span class="statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></span></td>
                                <td><?= $litter->has('birth_date') ? h($litter->birth_date->i18nFormat('dd/MM/yyyy')) : __('Unknown date') ?></td>
                                <td><?= !empty($litter->dam) ? h($litter->dam[0]->usual_name) : __('Unknown') ?></td>
                                <td><?= !empty($litter->sire) ? h($litter->sire[0]->usual_name) : __('Unknown') ?></td>
                                <td><?= $this->Number->format($litter->pups_number) ?></td>
                                <td class="actions">
                                    <?= $this->Html->image('/img/icon-view.svg', [
                                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                                        'class' => 'action-icon',
                                        'alt' => __('See Litter')]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </details>

                <details open>
                    <summary>Recently modified rats</summary>
                    <?= $this->element('simple_rats', [ //rats
                        'rubric' => __(''),
                        'rats' =>  $rattery->rats,//$offsprings,
                        'exceptions' => [
                            'picture',
                            'owner_user_id',
                            'death_primary_cause',
                            'death_secondary_cause',
                        ],
                    ]) ?>
                </details>

            <?php endif; ?> <!-- end non generic rattery part -->

            <div class="signature">
            &mdash; Created on <?= $rattery->created->i18nFormat('dd/MM/yyyy') ?>. <?= ($rattery->has('modified') && ($rattery->modified != $rattery->created)) ? 'Last modified on ' . $rattery->modified->i18nFormat('dd/MM/yyyy') .'.' : '' ?>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
