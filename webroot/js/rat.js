document.addEventListener('DOMContentLoaded', function() {
    var placeholdersData = document.getElementById('json-placeholders');
    var placeholders = JSON.parse(placeholdersData.getAttribute('data-json'));

    $("#jquery-color-select").selectize( {
        placeholder: placeholders['colors'],
        maxItems: 1,
        plugins: ['remove_button']
    });

    $("#jquery-eyecolor-select").selectize( {
        placeholder: placeholders['eyecolors'],
        maxItems: 1,
        plugins: ['remove_button']
    });

    $("#jquery-coat-select").selectize( {
        placeholder: placeholders['coats'],
        maxItems: 1,
        plugins: ['remove_button']
    });

    $("#jquery-dilution-select").selectize( {
        placeholder: placeholders['dilutions'],
        maxItems: 1,
        plugins: ['remove_button']
    });

    $("#jquery-earset-select").selectize( {
        placeholder: placeholders['earsets'],
        maxItems: 1,
        plugins: ['remove_button']
    });

    $("#jquery-marking-select").selectize( {
        placeholder: placeholders['markings'],
        maxItems: 1,
        plugins: ['remove_button']
    });

    $("#jquery-singularity-select").selectize( {
        placeholder: placeholders['singularities'],
        maxItems: 8,
        plugins: ['remove_button']
    });
});


// death
document.addEventListener('DOMContentLoaded', function() {
  var jsMessagesData = document.getElementById('json-jsMessages');
  var jsMessages = JSON.parse(jsMessagesData.getAttribute('data-json'));

  $(function() {
    $('#is-dead').on('change', function() {
        var show_death = $(this).is(':checked');
        if (show_death === true) {
            $('#death_div').removeClass("hide-everywhere");
            $('#death_date').prop('required', true);
            $('#primaries').prop('required', true);
        } else {
            $('#death_div').addClass("hide-everywhere");
            $('#death_date').prop('required', false);
            $('#primaries').prop('required', false);
        };
    });

  $('#primaries').change(function() {
    $.ajax({
            url: '/death-secondary-causes/find-by-primary.json',
            dataType: 'json',
            data: {
                'deathprimarykey': $('#primaries').val(),
            },
      success: function(data) {
                $("#secondaries option").remove();
                $('#secondaries').append($("<option></option>").attr("value","").text(""));
                $('#secondary-desc').empty();
                $('#secondary-desc').append(jsMessages[0]);
                for (var item in data.items) {
                    var x = document.getElementById("secondaries");
                    var option = document.createElement("option");
                    option.value = data.items[item].id;
                    option.text = data.items[item].value;
                    x.add(option);
                }
            },
        });
      });
  });

  $(function() {
    $('#primaries').change(function() {
      $.ajax({
            url: '/death-primary-causes/description.json',
            dataType: 'json',
            data: {
                'id': $('#primaries').val(),
            },
            success: function(data) {
                var p = document.getElementById("primary-desc");
                var comment = data.items['0'].value;
                if (comment == "-") {
                    p.innerHTML = jsMessages[1];
                } else {
                    p.innerHTML = comment;
                }
            },
        });
      });
  });

  $(function() {
      $('#secondaries').change(function() {
      $.ajax({
              url: '/death-secondary-causes/description.json',
              dataType: 'json',
              data: {
                  'id': $('#secondaries').val(),
              },
        success: function(data) {
                  var p = document.getElementById("secondary-desc");
                  var comment = data.items['0'].value;
                  if (comment == "-") {
                      p.innerHTML = jsMessages[1];
                  } else {
                      p.innerHTML = comment;
                  }
              },
          });
      });
  });
});


// add rat
$(function() {
    $(window).on('load', function() {
        if (! $("#jquery-owner-id").val() == '') {
            $("#jquery-owner-input").addClass("autocompleted");
        }
        if (! $("#jquery-mother-id").val() == '') {
            $("#jquery-mother-input").addClass("autocompleted");
        }
        if (! $("#jquery-father-id").val() == '') {
            $("#jquery-father-input").addClass("autocompleted");
        }
        if (! $("#jquery-rattery-id").val() == '') {
            $("#jquery-rattery-input").addClass("autocompleted");
        }
    });
});

$(function () {
    $('#jquery-owner-input')
        .on('input', function() {
            $("#jquery-owner-id").val('');
            if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                $(this).removeClass('autocompleted');
            }
        })
        .autocomplete({
            minLength: 3,
            source: function (request, response) {
                $.ajax({
                    /*url: $('#jquery-owner-form').attr('action') + '.json',*/
                    url: '/users/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-owner-input').val(),
                    },
                    success: function (data) {
                        response(data.items);
                    },
                    open: function () {
                        $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                    },
                    close: function () {
                        $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                    }
                });
            },
            select: function (event, ui) {
                $("#jquery-owner-input").val(ui.item.value); // display the selected text
                $("#jquery-owner-input").addClass("autocompleted"); // display the selected text
                $("#jquery-owner-id").val(ui.item.id); // save selected id to hidden input
            }
        }
    );
});

// autocomplete for mother
$(function () {
    $('#jquery-mother-input')
        .on('input', function() {
            $("#jquery-mother-id").val('');
            if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                $(this).removeClass('autocompleted');
            }
        })
        .autocomplete({
            minLength: 4,
            source: function (request, response) {
                $.ajax({
                    url: '/rats/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-mother-input').val(),
                        'sex': 'F',
                    },
                    success: function (data) {
                        response(data.items);
                    },
                    open: function () {
                        $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                    },
                    close: function () {
                        $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                    }
                });
            },
            select: function (event, ui) {
                $("#jquery-mother-input").val(ui.item.value); // display the selected text
                $("#jquery-mother-input").addClass("autocompleted"); // apply style
                $("#jquery-mother-id").val(ui.item.id); // save selected id to hidden input
            }
        });
});

$(function () {
  $('#jquery-father-input')
      .on('input', function() {
          $("#jquery-father-id").val('');
          if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
              $(this).removeClass('autocompleted');
          }
      })

      .autocomplete({
          minLength: 4,
          source: function (request, response) {
              $.ajax({
                  /*url: $('#jquery-owner-form').attr('action') + '.json',*/
                  url: '/rats/autocomplete.json',
                  dataType: 'json',
                  data: {
                      'searchkey': $('#jquery-father-input').val(),
                      'sex': 'M',
                  },
                  success: function (data) {
                      response(data.items);
                  },
                  open: function () {
                      $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                  },
                  close: function () {
                      $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                  }
              });
          },
          select: function (event, ui) {
              $("#jquery-father-input").val(ui.item.value); // display the selected text
              $("#jquery-father-input").addClass("autocompleted"); // display the selected text
              $("#jquery-father-id").val(ui.item.id); // save selected id to hidden input
          }
      });
});

$(function () {
    $('#jquery-rattery-input')
        .on('input', function() {
            $("#jquery-rattery-id").val('');
            if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                $(this).removeClass('autocompleted');
            }
        })
        .autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    /*url: $('#jquery-owner-form').attr('action') + '.json',*/
                    url: '/ratteries/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-rattery-input').val(),
                    },
                    success: function (data) {
                        response(data.items);
                    },
                    open: function () {
                        $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                    },
                    close: function () {
                        $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                    }
                });
            },
            select: function (event, ui) {
                $("#jquery-rattery-input").val(ui.item.value); // display the selected text
                $("#jquery-rattery-input").addClass("autocompleted"); // display the selected text
                $("#jquery-rattery-id").val(ui.item.id); // save selected id to hidden input
            }
        });
});

// attach rat
$(function() {
    $(window).on('load', function() {
        if (! $("#jquery-rat-input").val() == '') {
            $("#jquery-rat-input").addClass("autocompleted");
        }
    });
});

$(function () {
    $('#jquery-rat-input')
        .on('input', function() {
            $("#jquery-rat-id").val('');
            if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                $(this).removeClass('autocompleted');
            }
        })

        .autocomplete({
            minLength: 4,
            source: function (request, response) {
                $.ajax({
                    url: '/rats/autocomplete.json',
                    dataType: 'json',
                    data: {
                        'searchkey': $('#jquery-rat-input').val(),
                    },
                    success: function (data) {
                        response(data.items);
                    },
                    open: function () {
                        $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                    },
                    close: function () {
                        $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                    }
                });
            },
            select: function (event, ui) {
                $("#jquery-rat-input").val(ui.item.value); // display the selected text
                $("#jquery-rat-input").addClass("autocompleted"); // apply style
                $("#jquery-rat-id").val(ui.item.id); // save selected id to hidden input
            }
        });
});
