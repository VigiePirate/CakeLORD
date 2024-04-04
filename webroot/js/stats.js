Chart.defaults.font.family = "Imprima";
Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(102,51,0,1)';
Chart.defaults.plugins.tooltip.position = 'nearest';

document.addEventListener('DOMContentLoaded', function() {
      // media query for aspect ratio on mobile
      var smartphone = window.matchMedia("(max-width: 640px)").matches;

      // age pyramid
      var jsLegendsElement = document.getElementById('json-jsLegends');
      var jsLegends = JSON.parse(jsLegendsElement.getAttribute('data-json'));
      var aliveMalesDistribution = document.getElementById('json-aliveMalesDistribution');
      var pyramid_M_json = JSON.parse(aliveMalesDistribution.getAttribute('data-json'));
      var aliveFemalesDistribution = document.getElementById('json-aliveFemalesDistribution');
      var pyramid_F_json = JSON.parse(aliveFemalesDistribution.getAttribute('data-json'));
      var pyramidNorm = document.getElementById('json-pyramidNorm');
      var pyramid_norm = JSON.parse(pyramidNorm.getAttribute('data-json'));
      drawPyramid(pyramid_M_json, pyramid_F_json, pyramid_norm, jsLegends, smartphone);

      // lifespan by birth years
      var expectancy = document.getElementById('json-expectancy');
      var expectancy_json = JSON.parse(expectancy.getAttribute('data-json'));
      var lifespan = document.getElementById('json-lifespan');
      var global_lifespan = JSON.parse(lifespan.getAttribute('data-json'));
      drawLifespan(expectancy_json, global_lifespan, jsLegends, smartphone);

      // littersize distribution
      var littersizeNorm = document.getElementById('json-littersizeNorm');
      var littersize_norm = JSON.parse(littersizeNorm.getAttribute('data-json'));
      var littersizeDistribution = document.getElementById('json-littersizeDistribution');
      var littersize_json= JSON.parse(littersizeDistribution.getAttribute('data-json'));
      drawLitterSize(littersize_json, littersize_norm, jsLegends, smartphone);

      // sex balance
      var littersex = document.getElementById('json-littersex');
      var littersex_json = JSON.parse(littersex.getAttribute('data-json'));
      drawSexBalance(littersex_json, littersize_norm, jsLegends, smartphone);

      // mortality
      var mortality = document.getElementById('json-mortality');
      var mortality_json = JSON.parse(mortality.getAttribute('data-json'));
      var mortalityNorm = document.getElementById('json-mortalityNorm');
      var norm = JSON.parse(mortalityNorm.getAttribute('data-json'));
      var survival = document.getElementById('json-survival');
      var survival_json = JSON.parse(survival.getAttribute('data-json'));
      var rate = document.getElementById('json-rate');
      var rate_json = JSON.parse(rate.getAttribute('data-json'));
      drawMortality(mortality_json, norm, survival_json, rate_json, jsLegends, smartphone);
});

// Age pyramid by sex
function drawPyramid(pyramid_M_json, pyramid_F_json, pyramid_norm, jsLegends, smartphone) {
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
                  label: jsLegends["Females"], //'Females',
                  data: pyramid_F_data,
                  backgroundColor: pyramid_F_colors,
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
              },
              {
                  label: jsLegends["Males"],
                  data: pyramid_M_data,
                  backgroundColor: pyramid_M_colors,
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
              }
          ]
      },
      options: {
          aspectRatio: smartphone ? 1.1 : 1.5,
          scales: {
              x: {
                  stacked:true,
                  title: {
                      display: true,
                      text: jsLegends["Age (in months)"],
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
                      text: jsLegends["Number of alive rats"],
                  }
              }
          },
          responsive: true,
          plugins: {
              legend: {
                  text: jsLegends["Age"],
                  position: 'top',
              },
              title: {
                  display: true,
                  text: jsLegends["Age pyramid"],
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
                              label += Math.round(100*context.parsed.y)/100 + " " + jsLegends["(presumed) alive rats"];
                          }
                          if (context.datasetIndex === 1) {
                              label += (-1*Math.round(100*context.parsed.y)/100).toString() + " " + jsLegends["(presumed) alive rats"];
                          }
                          return label;
                      },
                      title: function(context) {
                          var title = jsLegends["Age: between"]+ " " + context[0].label + " " + jsLegends["and"] + " " + (parseInt(context[0].label)+1).toString() + " " + jsLegends["months"];
                          return title;
                      }
                  }
              }
          }
      }
  }
  var pyramid_chart = new Chart(pyramid_ctx, pyramid_config);
}

  // Average lifespan by birth years
function drawLifespan(expectancy_json, global_lifespan, jsLegends, smartphone) {
  var expectancy_labels = expectancy_json.map(function(e) {
      return e.year;
  });
  var expectancy_data = expectancy_json.map(function(e) {
      return e.lifespan;
  });
  var global_data = expectancy_json.map(function(e) {
      return 30.5*global_lifespan;
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
                  label: jsLegends["All-time average"],
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
                  label: jsLegends["Average lifespan by birth year"],
                  data: expectancy_data,
                  backgroundColor: expectancy_colors,
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
                  pointStyle: 'rect',
              }
          ]
      },
      options: {
          aspectRatio: smartphone ? 1.1 : 1.5,
          scales: {
              x: {
                  title: {
                      display: true,
                      text: jsLegends["Birth year"],
                  }
              },
              y: {
                  beginAtZero: true,
                  title: {
                      display: true,
                      text: jsLegends["Average lifespan (in days)"]
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
                  text: jsLegends["Life expectancy"],
              },
              tooltip: {
                  caretPadding: 12,
                  displayColors: true,
                  callbacks: {
                      label: function(context) {
                          var label = '';
                          console.log(context);
                          if (context.datasetIndex === 0) {
                              label += jsLegends["All-time average:"] + " " + Math.round(100*context.parsed.y)/100 + " " + jsLegends["days"];
                          }
                          if (context.datasetIndex === 1) {
                              label += jsLegends["Average lifespan:"] + " " + Math.round(100*context.parsed.y)/100 + " " + jsLegends["days"];
                          }
                          return label;
                      },
                      title: function(context) {
                          var title = jsLegends["Rats born in"] + " "+context[0].label;
                          return title;
                      }
                  }
              }
          }
      }
  };
  var expectancy_chart = new Chart(expectancy_ctx, expectancy_config);
}

// Litter size distribution
function drawLitterSize(littersize_json, littersize_norm, jsLegends, smartphone) {
  var littersize_labels = Object.keys(littersize_json);
  var littersize_data = (Object.values(littersize_json)).map(function (e) {
      return 100*e/littersize_norm;
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
              label: jsLegends["Total litter size"],
              data: littersize_data,
              backgroundColor: littersize_colors,
              hoverBackgroundColor: 'rgba(102,51,0,1)',
          }]
      },
      options: {
          aspectRatio: smartphone ? 1.2 : 1.5,
          scales: {
              x: {
                  title: {
                      display: true,
                      text: jsLegends["Litter size (number of pups)"],
                  }
              },
              y: {
                  beginAtZero: true,
                  title: {
                      display: true,
                      text: jsLegends["Proportion of litters (%)"],
                  }
              }
          },
          responsive: true,
          plugins: {
              legend: {
                  text: jsLegends["Age"],
                  position: 'top',
              },
              title: {
                  display: true,
                  text: jsLegends["Litter size distribution (% of litters)"],
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
                              label = Math.round(100*context.parsed.y)/100 + " " + jsLegends["% of litters"];
                          }
                          return label;
                      },
                      title: function(context) {
                          //var title = 'Rats between '+(parseInt(context[0].parsed.x)-0.5).toString()+' and '+ (parseInt(context[0].parsed.x)+0.5).toString()+' months ';
                          var title = context[0].label + " " + jsLegends["pups"];
                          return title;
                      }
                  }
              }
          }
      }
  }
  var littersize_chart = new Chart(littersize_ctx, littersize_config);
}

// sex balance distribution
function drawSexBalance(littersex_json, littersex_norm, jsLegends, smartphone) {
  var littersex_M_json = Object.entries(littersex_json).reduce((acc, [key, value]) => {
        if (parseInt(key) > 0) {
          acc[key] = value;
        }
        return acc;
      }, {});

  var littersex_X_json = Object.entries(littersex_json).reduce((acc, [key, value]) => {
        if (parseInt(key) == 0) {
          acc[key] = value;
        }
        return acc;
      }, {});

  var littersex_F_json = Object.entries(littersex_json).reduce((acc, [key, value]) => {
        if (parseInt(key) < 0) {
          acc[key] = value;
        }
        return acc;
      }, {});

  var littersex_M_labels = Object.keys(littersex_M_json);
  var littersex_M_data = (Object.values(littersex_M_json)).map(function (e) {
      return 100*e/littersex_norm;
  });
  var littersex_M_max = Math.max(...littersex_M_data);
  var littersex_M_colors = littersex_M_data.map(function(e) {
      return 'rgba(153,204,255,'+(0.5+0.5*(e/littersex_M_max)).toString()+')';
  });

  var littersex_X_labels = Object.keys(littersex_X_json);
  var littersex_X_data = (Object.values(littersex_X_json)).map(function (e) {
      return 100*e/littersex_norm;
  });
  var littersex_X_max = Math.max(...littersex_X_data);
  var littersex_X_colors = littersex_X_data.map(function(e) {
      return 'rgba(61, 75, 153, '+(0.25+0.5*(e/littersex_X_max)).toString()+')';
  });

  var littersex_F_labels = Object.keys(littersex_F_json);
  var littersex_F_data = (Object.values(littersex_F_json)).map(function (e) {
      return 100*e/littersex_norm;
  });
  var littersex_F_max = Math.max(...littersex_F_data);
  var littersex_F_colors = littersex_F_data.map(function(e) {
      return 'rgba(255,153,204, '+(0.5+0.5*(e/littersex_F_max)).toString()+')';
  });

  var littersex_labels = (littersex_F_labels.concat(littersex_X_labels)).concat(littersex_M_labels);

  var littersex_ctx = document.getElementById('littersex-chart').getContext('2d');
  var littersex_config = {
      type: 'bar',
      data: {
          labels: littersex_labels,
          datasets: [
              {
                  label: jsLegends["Litters with more females"],
                  //data: littersex_F_data,
                  data: Object.values(littersex_F_data).concat(new Array(Object.keys(littersex_X_data).length).fill(0)).concat(new Array(Object.keys(littersex_M_data).length).fill(0)),
                  backgroundColor: littersex_F_colors,
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
              },
              {
                  label: jsLegends["Sex-balanced litters"],
                  //data: littersex_X_data,
                  data: new Array(Object.keys(littersex_F_data).length).fill(0).concat(Object.values(littersex_X_data)).concat(new Array(Object.keys(littersex_M_data).length).fill(0)),
                  backgroundColor: littersex_X_colors,
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
              },
              {
                  label: jsLegends["Litters with more males"],
                  //data: littersex_M_data,
                  data: new Array(Object.keys(littersex_F_data).length + Object.keys(littersex_X_data).length).fill(0).concat(Object.values(littersex_M_data)),
                  backgroundColor: littersex_M_colors,
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
              }
          ]
      },
      options: {
          aspectRatio: smartphone ? 1.1 : 1.5,
          scales: {
              x: {
                  stacked: true,
                  title: {
                      display: true,
                      text: jsLegends["Sex gap (males minus females)"],
                  },
                  min: littersex_F_labels.length - 9,
                  max: littersex_F_labels.length + 9,
              },
              y: {
                  stacked: false,
                  beginAtZero: true,
                  title: {
                      display: true,
                      text: jsLegends["Proportion of litters (%)"],
                  }
              }
          },
          responsive: true,
          plugins: {
              legend: {
                  text: jsLegends["Age"],
                  position: 'top',
              },
              title: {
                  display: true,
                  text: jsLegends["Sex gap distribution among litters (% of litters)"],
              },
              tooltip: {
                  caretPadding: 12,
                  displayColors: false,
                  callbacks: {
                      label: function(context) {
                          if (context.parsed.y !== null) {
                              label = Math.round(100*context.parsed.y)/100 + " " + jsLegends["% of litters"];
                          }
                          return label;
                      },
                      title: function(context) {
                          var gap = context[0].label;

                          if (gap < -1) {
                              var title = Math.abs(context[0].label) + jsLegends[" more females than males"];
                          }

                          if (gap == -1) {
                              var title = Math.abs(context[0].label) + jsLegends[" more female than males"];
                          }

                          if (gap == 0) {
                              var title = jsLegends["As many females as males"];
                          }

                          if (gap == 1) {
                              var title = context[0].label + jsLegends[" more male than females"];
                          }

                          if (gap > 1) {
                              var title = context[0].label + jsLegends[" more males than females"];
                          }

                          return title;
                      }
                  }
              }
          }
      }
  }
  var littersex_chart = new Chart(littersex_ctx, littersex_config);
}

// Mortality distribution, rate and survival
function drawMortality(mortality_json, norm, survival_json, rate_json, jsLegends, smartphone) {
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

  var survival_data = survival_json.map(function(e) {
      return e.count;
  });

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
                  label: jsLegends["Survival rate"],
                  data: survival_data,
                  backgroundColor: 'rgba(102,51,0,1)',
                  borderColor: 'rgba(102,51,0,1)',
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
                  xAxisID: 'xtrunc',
                  yAxisID: 'yleft'
              },
              {
                  type: 'bar',
                  label: jsLegends["Mortality distribution"],
                  data: mortality_data,
                  borderColor: mortality_colors,
                  backgroundColor: mortality_colors,
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
                  xAxisID: 'xtrunc',
                  yAxisID: 'yright'
              },
              {
                  type: 'bar',
                  label: jsLegends["Mortality probability"],
                  data: rate_data,
                  borderColor: rate_colors,
                  backgroundColor: rate_colors,
                  hoverBackgroundColor: 'rgba(102,51,0,1)',
                  xAxisID: 'xtrunc',
                  yAxisID: 'yright'
              },
          ]
      },
      options: {
          aspectRatio: smartphone ? 0.85 : 1.5,
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
                      text: jsLegends["Age (in months)"],
                      font: {
                          weight: 700,
                          size: 12,
                      }
                  },
                  ticks: {
                      font: {
                          size: 10
                      }
                  },
              },
              yleft: {
                  type: 'linear',
                  display: true,
                  position: 'left',
                  title: {
                      display: true,
                      text: jsLegends["Survival rate (%)"],
                      color: 'rgba(102, 51, 0, 1)',
                      font: {
                          weight: 700,
                          size: 12
                      }
                  },
                  ticks: {
                      font: {
                          size: 12,

                      },
                      fontColor: 'rgba(102, 51, 0, 1)',
                      stepSize: 5,
                  }
              },
              yright: {
                  type: 'linear',
                  display: true,
                  position: 'right',
                  max: 30,
                  title: {
                      display: true,
                      text: jsLegends["Death probabilities (%)"],
                      color: 'rgba(61, 75, 153, 1)',
                      font: {
                          weight: 700,
                          size: 12
                      }
                  },
                  ticks: {
                      font: {
                          size: 12,

                      },
                      fontColor: 'rgba(61, 75, 153, 1)',
                      stepSize: 3,
                  },
                  grid: {
                      drawOnChartArea: false, // only want the grid lines for one axis to show up
                  },
              },
          },
          plugins: {
              title: {
                   display: true,
                   text: jsLegends['All-time survival and mortality by age'],
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
                              label += Math.round(100*context.parsed.y)/100 + " " + jsLegends['% of all rats reach this age'];
                          }
                          if (context.datasetIndex === 1) {
                              label += Math.round(100*context.parsed.y)/100 + " " + jsLegends['% of all deaths occur in rats of this age'];
                          }
                          if (context.datasetIndex === 2) {
                              label += Math.round(100*context.parsed.y)/100 + " " + jsLegends['% of all rats reaching this age die in the following month'];
                          }
                          return label;
                      },
                      title: function(context) {
                          var title = jsLegends["Age: between "]+ context[0].label+ jsLegends[" and "] + (parseInt(context[0].label)+1).toString() + jsLegends[" months"];
                          return title;
                      }
                  }
              }
          }
      }
  }
  var mortality_chart = new Chart(mortality_ctx, mortality_config);
}
