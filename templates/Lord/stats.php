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
                <?= __('These statistics are computed automatically from users’ data, which can be inaccurate or incomplete (especially legacy data migrated from the previous LORD version). Therefore, they must be interpreted carefully. For more details, please read the FAQ.') ?>
            </div>

            <h2><?= __('Demography') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Total number of rats:') ?></th>
                    <td><?= h($rat_count) . ' ' . __('rats') ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('females:') ?></th>
                    <td> ⨽ <?= h($female_count) . ' females (' . h($female_frequency) .' %)' ?></td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('males:') ?></th>
                    <td> ⨽ <?= h($male_count) . ' males (' . h($male_frequency) .' %)' ?></td>
                </tr>

            </table>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Rats considered as deceased:') ?></th>
                    <td> <?= h($dead_rat_count) ?> rats (<?= h($dead_rat_frequency) ?> % of all rats) </td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('declared with known date:') ?></th>
                    <td> ⨽ <?= h($knowingly_dead_rat_count) ?> rats (<?= h($knowingly_dead_rat_frequency) ?> % of deceased rats) </td>
                </tr>
                <tr>
                    <th> ⨽ <?= __('presumably dead:') ?></th>
                    <td> ⨽ <?= h($dead_rat_count - $knowingly_dead_rat_count) ?> rats (<?= h(100 - $knowingly_dead_rat_frequency) ?> % of deceased rats) </td>
                </tr>
            </table>

            <table class="condensed stats">

                <tr>
                    <th><?= __('Lifespan:') ?></th>
                    <td></td>
                </tr>
                <tr>
                    <th> ⨽ average:</th>
                    <td> ⨽ <?= h($lifespan) . __(' months') ?> (♀: <?= h($female_lifespan) ?>, ♂: <?= h($male_lifespan) ?>)
                </tr>
                <tr>
                    <th> ⨽ average, infant mortality excluded:</th>
                    <td> ⨽ <?= h($not_infant_lifespan) . __(' months') ?> (♀: <?= h($not_infant_female_lifespan) ?>, ♂: <?= h($not_infant_male_lifespan) ?>)
                </tr>
                <tr>
                    <th> ⨽ average, accidents also excluded:</th>
                    <td> ⨽ <?= h($not_accident_lifespan) . __(' months') ?> (♀: <?= h($not_accident_female_lifespan) ?>, ♂: <?= h($not_accident_male_lifespan) ?>)
                </tr>
                <tr>
                    <th> ⨽ maximum:</th>
                    <td> ⨽ <?= h($champion->champion_age_string) ?> (<?= $this->Html->link(h($champion->usual_name),['controller' => 'Rats', 'action' => 'view', $champion->id]); ?>)
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
            <table class="condensed stats">
                <tr>
                    <th><?= __('Total number of ratteries:') ?></th>
                    <td><?= h($rattery_count) ?> <?= __('ratteries') ?></td>
                </tr>
                <tr>
                    <th> ⨽ active in the last 2 years:</th>
                    <td> ⨽ <?= h($active_count) . ' ' . __('ratteries') . ' (' . h($active_frequency) .' %)' ?></td>
                </tr>

            </table>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Average rattery lifetime:') ?></th>
                    <td>
                        <?= h($rattery_lifetime)  . ' ' . __('days') ?>
                        <?= ' (' . h(round($rattery_lifetime/365,1))  . ' ' . __('years') . ')' ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Average rattery productivity:') ?></th>
                    <td><?= h($litters_by_rattery) . __(' litters') ?>, <?= h($pups_by_rattery) . __(' rats') ?></td>
                </tr>
                <tr>
                    <th> ⨽ as birth place:</th>
                    <td> ⨽ <?= h($litters_by_birthplace) . __(' internal litters') ?></td>
                </tr>
                <tr>
                    <th> ⨽ as other contributor:</th>
                    <td> ⨽ <?= h($litters_by_contributor) . __(' external litters') ?></td>
                </tr>
            </table>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Average mother age:') ?></th>
                    <td><?= h(round($avg_mother_age)) ?> days (<?= h(round($avg_mother_age/30.5,1)) ?> months)</td>
                </tr>
                <tr>
                    <th><?= __('Average father age:') ?></th>
                    <td><?= h(round($avg_father_age)) ?> days (<?= h(round($avg_father_age/30.5,1)) ?> months)</td>
                </tr>
                <tr>
                    <th><?= __('Average litter size:') ?></th>
                    <td><?= h($avg_litter_size) ?> pups (debiased estimation : <?= h($debiased_avg_litter_size) ?> pups)</td>
                </tr>
                <tr>
                    <th><?= __('Average sex ratio:') ?></th>
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

            <table class="condensed stats">
                <tr>
                    <th><?= __('Median death age:') ?></th>
                    <td><?= h($median) ?> months <span class="comment">(50 % of rats die before this age, 50 % after)</span></td>
                </tr>
                <tr>
                    <th><?= __('Death peak:') ?></th>
                    <td><?= h($max) ?> months <span class="comment">(death occurs more often at this age than any other)</span></td>
                </tr>
                <tr>
                    <th><?= __('Interquartile interval:') ?></th>
                    <td><?= h($quartiles['first']) . '-' . h($quartiles['last']) ?> months <span class="comment">(50% of rats die in this age interval)</span></td>
                </tr>
                <tr>
                    <th><?= __('Leading death category:') ?></th>
                    <td><?= '« ' . h($primaries[0]['name']) . ' »'?> <span class="comment"> <?=' ('. h(100*round($primaries[0]['count']/$knowingly_dead_rat_count,2)) . ' % of declared deaths)'?></span></td>
                </tr>
                <tr>
                    <th><?= __('Leading death cause:') ?></th>
                    <td><?= '« ' . h($secondaries[0]['name']) . ' »'?> <span class="comment"> <?=' ('. h(100*round($secondaries[0]['count']/$knowingly_dead_rat_count,2)) . ' % of declared deaths)'?></span></td>
                </tr>
            </table>

            <canvas id="mortality-chart"></canvas>

            <h3><?= __('Death categories') ?></h3>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Number of deaths with recorded cause:') ?></th>
                    <td><?= h($knowingly_dead_rat_count) ?> rats (<?= h(round($knowingly_dead_rat_count/$dead_rat_count,2)*100) ?> % of rats considered as dead) </td>
                </tr>
                <tr><th><?= __('By decreasing frequency:') ?></th>
                <td><span class="comment">* please note that tumours without recorded localization appear as « Autres »</span></td></tr>
            </table>

            <table class="condensed stats histogram">
                <?php foreach($primaries as $category): ?>
                    <tr>
                        <th>
                            <div style="opacity:<?= h(0.25+0.75*$category['count']/$primaries[0]['count']) ?>; width:<?= h($category['count']/$primaries[0]['count']*100) ?>%">
                                <?= h(round($category['count']/$knowingly_dead_rat_count*100,2)) ?> %
                            </div>
                        </th>
                        <td><?= h($category['name']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <h3><?= __('Most frequent death causes') ?></h3>

            <table class="condensed stats">
                <tr>
                    <th><?= __('Number of deaths with recorded cause:') ?></th>
                    <td><?= h($knowingly_dead_rat_count) ?> rats (<?= h(round($knowingly_dead_rat_count/$dead_rat_count,2)*100) ?> % of rats considered as dead) </td>
                </tr>
                <tr>
                    <th><?= __('By decreasing frequency:') ?></th>
                    <td><span class="comment">* for rats recorded as dead without precise cause, recorded death category is used instead</span></td>
                </tr>
            </table>

            <table class="condensed stats histogram">
                <?php foreach($secondaries as $cause): ?>
                    <tr>
                        <th>
                            <div style="opacity:<?= h(0.25+0.75*$cause['count']/$secondaries[0]['count']) ?>; width:<?= h($cause['count']/$secondaries[0]['count']*100) ?>%">
                                <?= h(round($cause['count']/$knowingly_dead_rat_count*100,2)) ?> %
                            </div>
                        </th>
                        <td><?= h($cause['name']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <h3><?= __('Most frequent tumours') ?></h3>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Number of tumour-related deaths:') ?></th>
                    <td><?= h($tumour_dead_count) ?> rats (<?= h(round($tumour_dead_count/$knowingly_dead_rat_count,4)*100) ?> % of rats with known death cause) </td>
                </tr>
                <tr><th><?= __('By decreasing frequency:') ?></th>
                    <td><span class="comment">* please note that tumour localization could not recorded before 2022</span></td>
            </tr>
            </table>
            <table class="condensed stats histogram">
                <?php foreach($tumours as $tumour): ?>
                    <tr>
                        <th>
                            <div style="opacity:<?= h(0.25+0.75*$tumour['count']/$tumours[0]['count']) ?>; width:<?= h($tumour['count']/$tumours[0]['count']*100) ?>%">
                                <?= h(round($tumour['count']/$tumour_dead_count*100,2)) ?> %
                            </div>
                        </th>
                        <td><?= h($tumour['name']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>

<?= $this->Html->css('stats.css') ?>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js') ?>
<script>
    Chart.defaults.font.family = "Imprima";
    Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(102,51,0,1)';
    Chart.defaults.plugins.tooltip.position = 'nearest';

    // Age pyramid by sex
    var pyramid_norm = <?= $rat_count - $dead_rat_count ?>;
    var pyramid_M_json = <?php echo $alive_males_distribution; ?>;
    var pyramid_M_labels = pyramid_M_json.map(function (e) {
        return e.months;
    });
    var pyramid_M_data = pyramid_M_json.map(function (e) {
        return -1*e.count;
    });
    var pyramid_M_max = Math.max(...pyramid_M_data);
    var pyramid_M_colors = pyramid_M_data.map(function(e) {
        return 'rgba(153,204,255,'+(0.25+0.75*(e/pyramid_M_max)).toString()+')';
    });

    var pyramid_F_json = <?php echo $alive_females_distribution; ?>;
    var pyramid_F_labels = pyramid_F_json.map(function (e) {
        return e.months;
    });
    var pyramid_F_data = pyramid_F_json.map(function (e) {
        return e.count;
    });
    var pyramid_F_max = Math.max(...pyramid_F_data);
    var pyramid_F_colors = pyramid_F_data.map(function(e) {
        return 'rgba(255,153,204, '+(0.25+0.75*(e/pyramid_F_max)).toString()+')';
    });

    var pyramid_ctx = document.getElementById('pyramid-chart').getContext('2d');
    var pyramid_config = {
        type: 'bar',
        data: {
            labels: pyramid_M_labels,
            datasets: [
                {
                    label: 'Females',
                    data: pyramid_F_data,
                    backgroundColor: pyramid_F_colors,
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                },
                {
                    label: 'Males',
                    data: pyramid_M_data,
                    backgroundColor: pyramid_M_colors,
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                }
            ]
        },
        options: {
            aspectRatio: 1.5,
            scales: {
                x: {
                    stacked:true,
                    title: {
                        display: true,
                        text: 'Age (in months)'
                    }
                },
                y: {
                    beginAtZero: true,
                    stacked:true,
                    ticks: {
                        callback: (val) => (Math.abs(val))
                    },
                    title: {
                        display: true,
                        text: 'Number of alive rats'
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    text: 'Age',
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Age pyramid'
                },
                tooltip: {
                    caretPadding: 4,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.datasetIndex === 0) {
                                label += Math.round(100*context.parsed.y)/100 + ' (presumed) alive rats';
                            }
                            if (context.datasetIndex === 1) {
                                label += (-1*Math.round(100*context.parsed.y)/100).toString()+' (presumed) alive rats';
                            }
                            return label;
                        },
                        title: function(context) {
                            var title = 'Age: between '+context[0].label+' and ' + (parseInt(context[0].label)+1).toString() + ' months';
                            return title;
                        }
                    }
                }
            }
        }
    }
    var pyramid_chart = new Chart(pyramid_ctx, pyramid_config);

    // Average lifespan by birth years
    var expectancy_json = <?php echo $expectancy; ?>;
    var expectancy_labels = expectancy_json.map(function(e) {
        return e.year;
    });
    var expectancy_data = expectancy_json.map(function(e) {
        return e.lifespan;
    });
    var global_data = expectancy_json.map(function(e) {
        return <?php echo h(30.5*$lifespan); ?>;
    });
    var expectancy_min = Math.min(...expectancy_data);
    var expectancy_max = Math.max(...expectancy_data);
    var expectancy_colors = expectancy_json.map(function(e) {
        return 'rgba(61, 75, 153,'+(0.5+0.5*(e.lifespan-expectancy_min)/(expectancy_max-expectancy_min)).toString()+')';
    });
    var expectancy_ctx = document.getElementById('expectancy-chart').getContext('2d');
    var expectancy_config = {
        type: 'bar',
        data: {
            labels: expectancy_labels,
            datasets: [
                {
                    type: 'line',
                    label: 'All-time average',
                    data: global_data,
                    backgroundColor: 'rgba(177, 0, 12,1)',
                    borderColor: 'rgba(177, 0, 12,1)',
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                    pointRadius: 0,
                    pointStyle: 'line',
                    borderDash: [5,5]
                },
                {
                    type: 'bar',
                    label: 'Average lifespan by birth year',
                    data: expectancy_data,
                    backgroundColor: expectancy_colors,
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                    pointStyle: 'rect',
                }
            ]
        },
        options: {
            aspectRatio:1.5,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Birth year'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Average lifespan (in days)'
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    display:true,
                    labels: {
                        usePointStyle: true
                    }
                },
                label: {
                    display:true,

                },
                title: {
                    display: true,
                    text: 'Life expectancy'
                },
                tooltip: {
                    caretPadding: 12,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            var label = '';
                            console.log(context);
                            if (context.datasetIndex === 0) {
                                label += 'All-time average: '+Math.round(100*context.parsed.y)/100 + ' days';
                            }
                            if (context.datasetIndex === 1) {
                                label += 'Average lifespan: '+Math.round(100*context.parsed.y)/100 + ' days';
                            }
                            return label;
                        },
                        title: function(context) {
                            var title = 'Rats born in '+context[0].label;
                            return title;
                        }
                    }
                }
            }
        }
    };
    var expectancy_chart = new Chart(expectancy_ctx, expectancy_config);

    // Litter size distribution
    var littersize_norm = <?= $nongeneric_litter_count ?>;
    var littersize_json = <?php echo $littersize_distribution; ?>;
    var littersize_labels = littersize_json.map(function(e) {
        return e.size;
    });
    var littersize_data = littersize_json.map(function(e) {
        return 100*e.count/littersize_norm;
    });
    var littersize_max = Math.max(...littersize_data);
    var littersize_colors = littersize_data.map(function(e) {
        return 'rgba(61, 75, 153,'+(0.25+0.75*e/littersize_max).toString()+')';
    });
    var littersize_ctx = document.getElementById('littersize-chart').getContext('2d');
    var littersize_config = {
        type: 'bar',
        data: {
            labels: littersize_labels,
            datasets: [{
                label: 'Total litter size',
                data: littersize_data,
                backgroundColor: littersize_colors,
                hoverBackgroundColor: 'rgba(102,51,0,1)',
            }]
        },
        options: {
            aspectRatio:1.5,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Litter size (number of pups)'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Proportion of litters (%)'
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    text: 'Age',
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Litter size distribution (% of litters)'
                },
                tooltip: {
                    caretPadding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            //var label = context.dataset.label || '';
                            //if (label) {
                            //    label += ': ';
                            //}
                            if (context.parsed.y !== null) {
                                label = Math.round(100*context.parsed.y)/100+' % of litters';
                            }
                            return label;
                        },
                        title: function(context) {
                            //var title = 'Rats between '+(parseInt(context[0].parsed.x)-0.5).toString()+' and '+ (parseInt(context[0].parsed.x)+0.5).toString()+' months ';
                            var title = context[0].label +' pups'; // why??
                            return title;
                        }
                    }
                }
            }
        }
    }
    var littersize_chart = new Chart(littersize_ctx, littersize_config);

    // distribution by sexes
    var littersex_norm = <?= $nongeneric_litter_count ?>;

    var littersex_M_json = <?php echo $males_in_litter_distribution; ?>;
    var littersex_M_labels = Object.keys(littersex_M_json);
    var littersex_M_data = (Object.values(littersex_M_json)).map(function (e) {
        return 100*e/littersex_norm;
    });
    var littersex_M_max = Math.max(...littersex_M_data);
    var littersex_M_colors = littersex_M_data.map(function(e) {
        return 'rgba(153,204,255,'+(0.25+0.75*(e/littersex_M_max)).toString()+')';
    });

    var littersex_F_json = <?php echo $females_in_litter_distribution; ?>;
    var littersex_F_labels = Object.keys(littersex_F_json);
    var littersex_F_data = (Object.values(littersex_F_json)).map(function (e) {
        return 100*e/littersex_norm;
    });
    var littersex_F_max = Math.max(...littersex_F_data);
    var littersex_F_colors = littersex_F_data.map(function(e) {
        return 'rgba(255,153,204, '+(0.25+0.75*(e/littersex_F_max)).toString()+')';
    });

    var littersex_ctx = document.getElementById('littersex-chart').getContext('2d');
    var littersex_config = {
        type: 'bar',
        data: {
            labels: littersex_M_labels,
            datasets: [
                {
                    label: 'Females',
                    data: littersex_F_data,
                    backgroundColor: littersex_F_colors,
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                },
                {
                    label: 'Males',
                    data: littersex_M_data,
                    backgroundColor: littersex_M_colors,
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                }
            ]
        },
        options: {
            aspectRatio:1.5,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Number of pups of the given sex'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Proportion of litters (%)'
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    text: 'Age',
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Litter size distribution by sex (% of litters)'
                },
                tooltip: {
                    caretPadding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            //var label = context.dataset.label || '';
                            //if (label) {
                            //    label += ': ';
                            //}
                            if (context.parsed.y !== null) {
                                label = Math.round(100*context.parsed.y)/100+' % of litters';
                            }
                            return label;
                        },
                        title: function(context) {
                            //var title = 'Rats between '+(parseInt(context[0].parsed.x)-0.5).toString()+' and '+ (parseInt(context[0].parsed.x)+0.5).toString()+' months ';
                            var title = 'Litters with '+context[0].label + ' ' +  (context[0].dataset.label).toLowerCase();
                            return title;
                        }
                    }
                }
            }
        }
    }
    var littersex_chart = new Chart(littersex_ctx, littersex_config);

    // Mortality distribution, rate and survival
    var mortality_json = <?php echo $mortality; ?>;
    var norm = <?php echo $knowingly_dead_rat_count; ?>;
    var mortality_labels = mortality_json.map(function(e) {
        return e.months;
    });
    var mortality_data = mortality_json.map(function(e) {
        return 100*e.count/norm;
    });
    var mortality_max = Math.max(...mortality_data);
    var mortality_colors = mortality_json.map(function(e) {
        return 'rgba(61, 75, 153,'+(0.25+0.75*(100*e.count/norm/mortality_max)).toString()+')';
    });
    var survival_json = <?php echo $survival; ?>;
    var survival_data = survival_json.map(function(e) {
        return e.count;
    });
    var rate_json = <?php echo $rate; ?>;
    var rate_data = rate_json.map(function(e) {
        return e.count;
    });
    var rate_max = Math.max(...rate_data);
    var rate_colors = rate_json.map(function(e) {
        return 'rgba(177, 0, 12,'+(0.25+0.75*(2*e.count/rate_max)).toString()+')';
    });
    var mortality_ctx = document.getElementById('mortality-chart').getContext('2d');
    var mortality_config = {

        data: {
            labels: mortality_labels,
            datasets: [
                {
                    type: 'line',
                    label: 'Survival rate',
                    data: survival_data,
                    backgroundColor: 'rgba(102,51,0,1)',
                    borderColor: 'rgba(102,51,0,1)',
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                    xAxisID: 'xtrunc',
                    yAxisID: 'yleft'
                },
                {
                    type: 'bar',
                    label: 'Mortality distribution',
                    data: mortality_data,
                    borderColor: mortality_colors,
                    backgroundColor: mortality_colors,
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                    xAxisID: 'xtrunc',
                    yAxisID: 'yright'
                },
                {
                    type: 'bar',
                    label: 'Mortality probability',
                    data: rate_data,
                    borderColor: rate_colors,
                    backgroundColor: rate_colors,
                    hoverBackgroundColor: 'rgba(102,51,0,1)',
                    xAxisID: 'xtrunc',
                    yAxisID: 'yleft'
                }
            ]
        },
        options: {
            aspectRatio:1.5,
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
                    min: 0,
                    max: 48,
                    title: {
                        display: true,
                        text: 'Age (in months)',
                        font: {
                            weight: 700
                        }
                    }
                },
                yleft: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Survival rate, mortality probabilities (%)',
                        color: 'rgba(177, 0, 12, 1)',
                        font: {
                            weight: 700
                        }
                    }
                },
                yright: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Mortality distribution (%)',
                        color: 'rgba(61, 75, 153, 1)',
                        font: {
                            weight: 700
                        }
                    },

                    // grid line settings
                    grid: {
                        drawOnChartArea: false, // only want the grid lines for one axis to show up
                    },
                },
            },
            plugins: {
                // legend: {
                //    text: 'Age',
                //    position: 'top',
                // },
                title: {
                     display: true,
                     text: 'All-time survival and mortality by age'
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
                                label += Math.round(100*context.parsed.y)/100 + ' % of all rats reach this age';
                            }
                            if (context.datasetIndex === 1) {
                                label += Math.round(100*context.parsed.y)/100+' % of all deaths occur in rats of this age';
                            }
                            if (context.datasetIndex === 2) {
                                label += Math.round(100*context.parsed.y)/100+' % of all rats reaching this age die in the following month';
                            }
                            return label;
                        },
                        title: function(context) {
                            var title = 'Age: between '+context[0].label+' and ' + (parseInt(context[0].label)+1).toString() + ' months';
                            return title;
                        }
                    }
                }
            }
        }
    }
    var mortality_chart = new Chart(mortality_ctx, mortality_config);

</script>
