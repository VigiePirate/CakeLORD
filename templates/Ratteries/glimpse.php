<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Rattery $rattery
*/
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h3 class="heading"><?= __('Actions') ?></h3>
            <?= $this->Html->link(__('View Rattery'), ['action' => 'view', $rattery->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Edit Rattery'), ['action' => 'edit', $rattery->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rattery'), ['action' => 'delete', $rattery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rattery->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ratteries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rattery'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries view content">

            <div class="float-right statemark statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></div>

            <h1><?= h($rattery->full_name)?></h1> <!-- . '&#8239;' . '<span>' . h($rattery->is_alive_symbol) . '</span>'-->

            <?php if($rattery->is_generic) : ?>
                <div class="message">This “rattery” is generic. Therefore, only a small number of relevant information are shown.</div>
            <?php endif ?>

            <h2>Information</h2>

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
                <?php endif ?> <!-- assuming generic ratteries do not want statistics! -->
                <?php if($rattery->wants_statistic) : ?>
                    <h3>Breeding statistics</h3>
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

                    <h3>Lifespan statistics</h3>
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
                                <th> ⨽ presumably dead:</th>
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
                                        ['controller' => 'Rats', 'action' => 'glimpse', $champion['id']]); ?>  (deceased at <?= h($champion['ageInWords']) ?>)
                                    </td>
                                </tr>
                            </table>
                            <h3>Death causes statistics</h3>
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
                <?php else : ?>
                    <div class="message warning">This rattery do not wish to show her statistics.</div>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>
</div>
