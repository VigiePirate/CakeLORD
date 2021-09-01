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
                <div class="side-nav-item">
                <?= $this->Html->image('/img/icon-locate.svg', [
                    'url' => ['controller' => 'Ratteries', 'action' => 'locate', $rattery->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('See on Map')]) ?>
                    <span class="side-nav-text hide-everywhere"><?= __('See on map') ?><span>
                </div>

                <div class="side-nav-item">
                <?= $this->Html->image('/img/icon-edit-rattery.svg', [
                    'url' => ['controller' => 'Ratteries', 'action' => 'edit', $rattery->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Modify Rattery')]) ?>
                    <span class="side-nav-text hide-everywhere"><?= __('Edit') ?><span>
                </div>

                <div class="side-nav-item">
                <?= $this->Html->image('/img/icon-add-litter.svg', [
                    'url' => ['controller' => 'Litters', 'action' => 'add'], //pass rattery id as contributor ? $rattery->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Declare Litter')]) ?>
                <span class="side-nav-text hide-everywhere"><?= __('Add litter') ?><span>
                </div>
            </div>

            <div class="side-nav-group">
                <div class="tooltip-staff">
                    <?= $this->Html->image('/img/icon-edit-as-staff.svg', [
                        'url' => ['controller' => 'Ratteries', 'action' => 'edit', $rattery->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Edit Rattery as Admin')]) ?>
                    <span class="tooltiptext-staff"><?= __('Edit rattery data as staff') ?></span>
                </div>

                <div class="tooltip-staff">
                    <?= $this->Html->image('/img/icon-delete.svg', [
                        'class' => 'side-nav-icon',
                        'alt' => __('Delete Rattery')]) ?>
                    <span class="tooltiptext-staff"><?= __('Delete rattery') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Rattery') ?></div>
                <?= $this->element('statebar', ['sheet' => $rattery]) ?>
            </div>

            <h1><?= h($rattery->full_name) . '<span> ' . h($rattery->is_alive_symbol) . '</span>'?></h1> <!-- -->

            <?php if($rattery->is_generic) : ?>
                <div class="message"><?= __('This “rattery” is generic. Therefore, only a small number of relevant information are shown.') ?></div>
            <?php endif ?>
            <h2>Information</h2>
            <div class="row">
                <?php if ($rattery->picture != '') : ?>
                <div class="column-responsive column-66">
                <?php else : ?>
                <div class="column-responsive column-100">
                <?php endif ?>
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
                            <th><?= __('Area') ?></th>
                            <td><?= h($rattery->district) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Zip Code') ?></th>
                            <td><?= h($rattery->zip_code) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Country') ?></th>
                            <td><?= $rattery->has('country') ? h($rattery->country->name) : '' ?></td>
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
            <div class="text">
                <blockquote>
                    <?= $this->Text->autoParagraph(h($rattery->comments)); ?>
                </blockquote>
            </div>
            <h2>Statistics</h2>
            <?php if ($stats['ratCount']==0 && $stats['outRatCount']==0) : ?>
                <div class="message error">No recorded rat was born in (or in partnership with) this rattery.</div>
            <?php else : ?>
                <?php if($rattery->is_generic) : ?>
                    <table class="condensed stats">
                        <tr>
                            <th>Recorded rats under this prefix:</th>
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
                <?php endif ?>
                <?php if($rattery->wants_statistic) : ?>
                    <details open>
                        <summary>Breeding statistics</summary>
                        <table class="condensed stats">
                            <tr>
                                <th>Breeding activity period:</th>
                                <td><?= h($stats['activityYears']) ?></td>
                            </tr>
                            <tr>
                                <th>Litter records (born in the rattery):</th>
                                <td><?= h($stats['inLitterCount']) ?> litter<?= h($stats['inLitterCount']<2) ? '' : 's' ?>, <?= h($stats['inRatCount']) ?> rat<?= h($stats['inRatCount']<2) ? '' : 's' ?></td>
                            </tr>
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
                        <table class="condensed stats">
                            <tr>
                                <th>Other contributed litters:</th>
                                <td><?= h($stats['outLitterCount']) ?> litter<?= h($stats['outLitterCount']<2) ? '' : 's' ?>, <?= h($stats['outRatCount']) ?> rat<?= h($stats['outRatCount']<2) ? '' : 's' ?><!--, with xx different partner ratteries--></td>
                            </tr>
                            <!-- Might be uncommented one day if we want to count males and females in contributed litters
                            <tr>
                            <th>Rats born in contributed litters: (outRatcount with male and female? (♀: , ♂: )</th>
                        </tr>-->
                        </table>
                    </details>
                    <details>
                        <summary>Lifespan statistics</summary>
                        <?php if($stats['ratCount']==0 && $stats['outRatCount']>0) : ?>
                            <div class="message">This rattery only had external external litters. Lifespan statistics can be consulted on each of their contributed litter sheets and on their partner ratteries. </div>
                        <?php else : ?>
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
                            <?php if ($stats['deadRatCount']>9) : ?>
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
                                        <!-- fixme -->
                                        <td><?= $this->Html->link(
                                            h($champion['name']),
                                            ['controller' => 'Rats', 'action' => 'view', $champion['id']]); ?>  (deceased at <?= h($champion['ageInWords']) ?>)
                                        </td>
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
                                    <?php foreach($stats['deathPrimary'] as $cause => $count) : ?>
                                        <tr>
                                            <th><div style="opacity:<?= h(0.25+0.75*$count/max($stats['deathPrimary'])) ?>; width:<?= h($count/max($stats['deathPrimary'])*100) ?>%"><?= h($count) ?> %</div></th>
                                            <td><?= h($cause) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>

                                <table class="condensed stats">
                                    <tr>
                                        <th>Secondary death causes by decreasing frequency:</th>
                                    </tr>
                                </table>
                                <!-- Now let us try to draw histograms with this -->
                                <table class="condensed stats histogram">
                                    <?php foreach($stats['deathSecondary'] as $cause => $count) : ?>
                                        <tr><th><div style="opacity:<?= h(0.25+0.75*$count/max($stats['deathSecondary'])) ?>; width:<?= h($count/max($stats['deathSecondary'])*100) ?>%"><?= h($count) ?> %</div></th>
                                            <td><?= h($cause) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>
                            <?php else : ?>
                                <div class="message">There aren't enough rats with reliable death information to compute relevant health statistics.</div>
                            <?php endif ?>
                        <?php endif ?>
                    </details>
            <?php else : ?>
                <div class="message warning">This rattery do not wish to show her statistics.</div>
            <?php endif ?>
        <?php endif ?>
        <div class="spacer"> </div>
        <?php // if($rattery->is_generic) : ?>
            <h2>Related entries</h2>
            <details>
                <summary>All Contributed Litters</summary>
                <table class="summary">
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
                        <?php foreach ($rattery->litters as $litter): ?>
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
            <?php if(! $rattery->is_generic) : ?>
                <details>
                    <summary>All Rats Born in the Rattery</summary>
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
            <?php endif; ?>
        <div class="spacer"> </div>
        <h2 class="staff">Private information</h2>
        <div class="signature">
            &mdash; Created on <?= $rattery->created->i18nFormat('dd/MM/yyyy') ?>. <?= ($rattery->has('modified') && ($rattery->modified != $rattery->created)) ? 'Last modified on ' . $rattery->modified->i18nFormat('dd/MM/yyyy') .'.' : '' ?>
        </div>
    </div>
</div>

<?= $this->Html->css('statebar.css') ?>
