$(function() {
    $(window).on('load', function() {
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

// autocomplete for father
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
