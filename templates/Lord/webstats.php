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

            <h1><?= __('Site statistics') ?></h1>

            <h2><?= __('Overview') ?></h2>

            <div class="stats-container">
                <div class="footer_section">
                    <?= $this->Html->image('/img/icon-user.svg', [
                    'url' => ['controller' => 'Users', 'action' => 'index'],
                    'class' => 'stat-icon',
                    'alt' => __('Users')]) ?>

                    <span class="stat-text"><span><?= h($user_count) ?></span> <?= __(' users') ?></span>
                </div>
                <div class="footer_section">
                    <?= $this->Html->image('/img/icon-rattery.svg', [
                    'url' => ['controller' => 'Ratteries', 'action' => 'index'],
                    'class' => 'stat-icon',
                    'alt' => __('Ratteries')]) ?>

                    <span class="stat-text"><span><?= h($rattery_count) ?></span> <?= __(' ratteries') ?></span>
                </div>
                <div class="footer_section">
                    <?= $this->Html->image('/img/icon-litter.svg', [
                    'url' => ['controller' => 'Litters', 'action' => 'index'],
                    'class' => 'stat-icon',
                    'alt' => __('Litters')]) ?>

                    <span class="stat-text"><span><?= h($litter_count) ?></span> <?= __(' litters') ?></span>
                </div>
                <div class="footer_section">
                    <?= $this->Html->image('/img/icon-rat.svg', [
                    'url' => ['controller' => 'Rats', 'action' => 'index'],
                    'class' => 'stat-icon',
                    'alt' => __('Rats')]) ?>

                    <span class="stat-text"><span><?= h($rat_count) ?></span> <?= __(' rats') ?></span>
                </div>
            </div>

            <h2><?= __('By year') ?></h2>

            <div class="row">
                <div class="column-responsive column-50">
                    <h3><?= __('Users (by registration)') ?></h3>
                    <canvas id="user-chart"></canvas>
                </div>
                <div class="column-responsive column-50">
                    <h3><?= __('Ratteries (by registration)') ?></h3>
                    <canvas id="rattery-chart"></canvas>
                </div>
            </div>

            <h3><?= __('Rats (by birth)') ?></h3>
            <canvas id="rat-chart"></canvas>
        </div>
    </div>
</div>

<?= $this->Html->css('stats.css') ?>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js') ?>
<script>
    Chart.defaults.font.family = "Imprima";
    Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(102,51,0,1)';

    // rats
    var rat_json = <?php echo $rat_birth; ?>;
    var rat_labels = rat_json.map(function(e) {
       return e.year;
    });
    var rat_data = rat_json.map(function(e) {
       return e.count;
    });
    var rat_max = Math.max(...rat_data);
    var rat_colors = rat_json.map(function(e) {
        return 'rgba(61, 75, 153,'+(0.25+0.75*e.count/rat_max).toString()+')';
    });
    var rat_ctx = document.getElementById('rat-chart').getContext('2d');
    var rat_config = {
       type: 'bar',
       data: {
          labels: rat_labels,
          datasets: [{
             label: 'Rats',
             data: rat_data,
             backgroundColor: rat_colors,
             hoverBackgroundColor: 'rgba(102,51,0,1)',
          }]
      },
      options: {
          aspectRatio: 3,
          scales: {
              y: {
                  beginAtZero: true
              }
          },
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
              display:false
            },
            title: {
              display: false,
              text: 'Rats by birth year'
            },
            tooltip: {
              caretPadding: 12,
              displayColors: false
            }
          }
      }
    };
    var chart = new Chart(rat_ctx, rat_config);

    // users
    var user_json = <?php echo $user_creation; ?>;
    var user_labels = user_json.map(function(e) {
       return e.year;
    });
    var user_data = user_json.map(function(e) {
       return e.count;
    });
    var user_max = Math.max(...user_data);
    var user_colors = user_json.map(function(e) {
        return 'rgba(61, 75, 153,'+(0.25+0.75*e.count/user_max).toString()+')';
    });
    var user_ctx = document.getElementById('user-chart').getContext('2d');
    var user_config = {
       type: 'bar',
       data: {
          labels: user_labels,
          datasets: [{
             label: 'Users',
             data: user_data,
             backgroundColor: user_colors,
             hoverBackgroundColor: 'rgba(102,51,0,1)',
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          },
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
              display:false
            },
            title: {
              display: false,
              text: 'Users by registration year'
          },
            tooltip: {
              caretPadding: 12,
              displayColors: false
            }
          }
      }
    };
    var chart = new Chart(user_ctx, user_config);

    // Ratteries
    var rattery_json = <?php echo $rattery_creation; ?>;
    var rattery_labels = rattery_json.map(function(e) {
       return e.year;
    });
    var rattery_data = rattery_json.map(function(e) {
       return e.count;
    });
    var rattery_max = Math.max(...rattery_data);
    var rattery_colors = rattery_json.map(function(e) {
        return 'rgba(61, 75, 153,'+(0.25+0.75*e.count/124).toString()+')';
    });
    var rattery_ctx = document.getElementById('rattery-chart').getContext('2d');
    var rattery_config = {
       type: 'bar',
       data: {
          labels: rattery_labels,
          datasets: [{
             label: 'Ratteries',
             data: rattery_data,
             backgroundColor: rattery_colors,
             hoverBackgroundColor: 'rgba(102,51,0,1)',
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          },
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
              display:false
            },
            title: {
              display: false,
              text: 'Ratteries by registration year'
            },
            tooltip: {
              caretPadding: 12,
              displayColors: false
            }
         }
      }
    };
    var chart = new Chart(rattery_ctx, rattery_config);
</script>
