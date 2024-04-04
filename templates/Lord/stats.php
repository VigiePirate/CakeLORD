<?php $this->assign('title', __('Statistics')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('About') ?></div>
            </div>

            <h1><?= __('Global statistics') ?></h1>

            <div class="message warning">
                <?= __('These statistics are computed automatically from users’ data, which can be inaccurate or incomplete (especially legacy data migrated from the previous LORD version). Therefore, they must be interpreted carefully. For more details, please read the guide.') ?>
            </div>

            <h2><?= __('Demography') ?></h2>
            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Total number of rats') ?></th>
                    <td><?=  __('{0, number} rats', [$rat_count]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('females') ?></th>
                    <td> ⨽ <?=  __('{0, number} females ({1, number} %)', [$female_count, $female_frequency]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('males') ?></th>
                    <td> ⨽ <?=  __('{0, number} males ({1, number} %)', [$male_count, $male_frequency]) ?></td>
                </tr>
            </table>

            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Rats considered as deceased') ?></th>
                    <td><?=  __('{0, number} rats ({1, number} % of all rats)', [$dead_rat_count, $dead_rat_frequency]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('declared with known date') ?></th>
                    <td> ⨽ <?= __('{0, number} rats ({1, number} % of deceased rats)', [$knowingly_dead_rat_count, $knowingly_dead_rat_frequency]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('presumably dead') ?></th>
                    <td> ⨽ <?= __('{0, number} rats ({1, number} % of deceased rats)', [$dead_rat_count - $knowingly_dead_rat_count, 100 - $knowingly_dead_rat_frequency]) ?></td>
                </tr>
            </table>

            <table class="condensed stats unfold">

                <tr>
                    <th><?= __('Lifespan') ?></th>
                    <td></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('average') ?></th>
                    <td> ⨽ <?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$lifespan, $female_lifespan, $male_lifespan]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('average, infant mortality excluded') ?></th>
                    <td> ⨽ <?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$not_infant_lifespan, $not_infant_female_lifespan, $not_infant_male_lifespan]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('average, accidents also excluded') ?></th>
                    <td> ⨽ <?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$not_accident_lifespan, $not_accident_female_lifespan, $not_accident_male_lifespan]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('maximum') ?></th>
                    <td> ⨽ <?= h($champion->champion_age_string) ?> (<?= $this->Html->link(h($champion->usual_name), ['controller' => 'Rats', 'action' => 'view', $champion->id]); ?>)
                    </td>
                </tr>
            </table>

            <div class="row">
                <div class="column-responsive column-50">
                    <canvas id="pyramid-chart"></canvas>
                </div>
                <div class="column-responsive column-50">
                    <canvas id="expectancy-chart"></canvas>
                </div>
            </div>

            <h2><?= __('Breeding') ?></h2>
            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Total number of ratteries') ?></th>
                    <td><?= __('{0, number} ratteries', [$rattery_count]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('active in the last 2 years') ?></th>
                    <td> ⨽ <?= __('{0, number} ratteries ({1, number} %)', [$active_count, $active_frequency]) ?></td>
                </tr>

            </table>
            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Average rattery lifetime') ?></th>
                    <td>
                        <?= __('{0, number} days ({1, number} years)', [$rattery_lifetime, round($rattery_lifetime/365, 1)]) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Average rattery productivity') ?></th>
                    <td><?= __('{0, number} litters ({1, number} rats)', [$litters_by_rattery, $pups_by_rattery]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('as birth place') ?></th>
                    <td> ⨽ <?= __('{0, number} internal litters', [$litters_by_birthplace]) ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('as other contributor') ?></th>
                    <td> ⨽ <?= __('{0, number} external litters', [$litters_by_contributor]) ?></td>
                </tr>
            </table>

            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Average mother age') ?></th>
                    <td><?= __('{0, number} days ({1, number} months)', [round($avg_mother_age), round($avg_mother_age/30.5,1)]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Average father age') ?></th>
                    <td><?= __('{0, number} days ({1, number} months)', [round($avg_father_age), round($avg_father_age/30.5,1)]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Average litter size') ?></th>
                    <td><?= __('{0, number} pups (debiased estimation: {1, number} pups)', [$avg_litter_size, $debiased_avg_litter_size]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Average sex ratio') ?></th>
                    <td><?= h($avg_sex_ratio) ?></td>
                </tr>
            </table>

            <div class="row">
                <div class="column-responsive column-50">
                    <canvas id="littersize-chart"></canvas>
                </div>
                <div class="column-responsive column-50">
                    <canvas id="littersex-chart"></canvas>
                </div>
            </div>

            <h2><?= __('Mortality') ?></h2>

            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Median death age') ?></th>
                    <td><?= __('{0, number} months', [$median]) ?> <span class="comment"><?= __('(50 % of rats die before this age, 50 % after)') ?></span></td>
                </tr>
                <tr>
                    <th><?= __('Death peak') ?></th>
                    <td><?= __('{0, number} months', [$max]) ?> <span class="comment"><?= __('(death occurs more often at this age than any other)') ?></span></td>
                </tr>
                <tr>
                    <th><?= __('Interquartile interval') ?></th>
                    <td><?= __('{0, number}-{1, number} months', [$quartiles['first'], $quartiles['last']]) ?> <span class="comment"><?= __('(50 % of rats die in this age interval)') ?></span></td>
                </tr>
                <tr>
                    <th><?= __('Leading death category') ?></th>
                    <td><?= __('“{0}”', [h($primaries[0]['name'])]) ?> <span class="comment"> <?= __('({0} % of declared deaths)', [h(100*round($primaries[0]['count']/$knowingly_dead_rat_count,2))]) ?></span></td>
                </tr>
                <tr>
                    <th><?= __('Leading death cause') ?></th>
                    <td><?= __('“{0}”', [h($secondaries[0]['name'])]) ?> <span class="comment"> <?= __('({0} % of declared deaths)', [h(100*round($secondaries[0]['count']/$knowingly_dead_rat_count,2))]) ?></span></td>
                </tr>
            </table>

            <canvas id="mortality-chart"></canvas>

            <h3><?= __('Death categories') ?></h3>

            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Number of recorded deaths') ?></th>
                    <td><?= __('{0, number} rats ({1, number} % of rats considered as dead)', [$knowingly_dead_rat_count, round($knowingly_dead_rat_count/$dead_rat_count,2)*100]) ?></td>
                </tr>
                <tr><th><?= __('By decreasing frequency') ?></th>
                <td><span class="comment">* <?= __('please note that tumours without recorded localization appear as « Autres »') ?></span></td></tr>
            </table>

            <table class="condensed stats histogram">
                <?php foreach($primaries as $category): ?>
                    <tr>
                        <th>
                            <div style="opacity:<?= h(0.25+0.75*$category['count']/$primaries[0]['count']) ?>; width:<?= h($category['count']/$primaries[0]['count']*100) ?>%">
                                <?= __('{0, number} %', [round($category['count']/$knowingly_dead_rat_count*100,2)]) ?>
                            </div>
                        </th>
                        <td><?= h($category['name']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <h3><?= __('Most frequent death causes') ?></h3>

            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Number of deaths with recorded cause') ?></th>
                    <td><?= __('{0, number} rats ({1, number} % of rats considered as dead)', [$knowingly_dead_rat_count, round($knowingly_dead_rat_count/$dead_rat_count,2)*100]) ?></td>
                </tr>
                <tr>
                    <th><?= __('By decreasing frequency') ?></th>
                    <td><span class="comment">* <?= __('for rats recorded as dead without precise cause, death category is used instead') ?></span></td>
                </tr>
            </table>

            <table class="condensed stats histogram">
                <?php foreach($secondaries as $cause): ?>
                    <tr>
                        <th>
                            <div style="opacity:<?= h(0.25+0.75*$cause['count']/$secondaries[0]['count']) ?>; width:<?= h($cause['count']/$secondaries[0]['count']*100) ?>%">
                                <?= __('{0, number} %', [round($cause['count']/$knowingly_dead_rat_count*100,2)]) ?>
                            </div>
                        </th>
                        <td><?= h($cause['name']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <h3><?= __('Most frequent tumours') ?></h3>
            <table class="condensed stats unfold">
                <tr>
                    <th><?= __('Number of tumour-related deaths') ?></th>
                    <td><?= __('{0, number} rats ({1, number} % of rats with known death cause)', [$tumour_dead_count, round($tumour_dead_count/$knowingly_dead_rat_count,4)*100]) ?></td>
                </tr>
                <tr><th><?= __('By decreasing frequency') ?></th>
                    <td><span class="comment">* <?= __('please note that tumour localization could not be recorded before 2023') ?></span></td>
            </tr>
            </table>
            <table class="condensed stats histogram">
                <?php foreach($tumours as $tumour): ?>
                    <tr>
                        <th>
                            <div style="opacity:<?= h(0.25+0.75*$tumour['count']/$tumours[0]['count']) ?>; width:<?= h($tumour['count']/$tumours[0]['count']*100) ?>%">
                                <?= __('{0, number} %', [round($tumour['count']/$tumour_dead_count*100,2)]) ?>
                            </div>
                        </th>
                        <td><?= h($tumour['name']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <div class="signature">
                &mdash; <?= __('Tell me more, tell me more... check our <a href={0} class="discrete-link">hall of fame</a>!',
                    [$this->Url->build(['controller' => 'Lord', 'action' => 'hallOfFame'])]) ?> </span>
            </div>

        </div>
    </div>
</div>

<!-- dump data for js -->
<div id="json-jsLegends" data-json="<?= htmlspecialchars($js_legends) ?>"></div>
<div id="json-aliveMalesDistribution" data-json="<?= htmlspecialchars($alive_males_distribution) ?>"></div>
<div id="json-aliveFemalesDistribution" data-json="<?= htmlspecialchars($alive_females_distribution) ?>"></div>
<div id="json-pyramidNorm" data-json="<?= $rat_count - $dead_rat_count ?>"></div>
<div id="json-expectancy" data-json="<?= htmlspecialchars($expectancy) ?>"></div>
<div id="json-lifespan" data-json="<?= $lifespan ?>"></div>
<div id="json-littersizeNorm" data-json="<?= $nongeneric_litter_count ?>"></div>
<div id="json-littersizeDistribution" data-json="<?= htmlspecialchars($littersize_distribution) ?>"></div>
<div id="json-littersex" data-json="<?= htmlspecialchars($sex_difference_in_litter_distribution) ?>"></div>
<div id="json-mortality" data-json="<?= htmlspecialchars($mortality) ?>"></div>
<div id="json-mortalityNorm" data-json="<?= $knowingly_dead_rat_count ?>"></div>
<div id="json-survival" data-json="<?= htmlspecialchars($survival) ?>"></div>
<div id="json-rate" data-json="<?= htmlspecialchars($rate) ?>"></div>

<?= $this->Html->css('stats.css') ?>
<?= $this->Html->script('chart.min.js') ?>
<?= $this->Html->script('stats.js') ?>
