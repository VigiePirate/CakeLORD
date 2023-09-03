function autocompleteRattery(visible, hidden) {

    $(window).on('load', function() {
        if (! $(hidden).val() == '') {
            $(visible).addClass("autocompleted");
            $(visible).removeClass("placeholder");
        }
    });

    $(visible)
      .on('input', function() {
          $(hidden).val('');
          if ($(visible).val() === '' || $(visible).val() === $(visible).attr('placeholder')) {
              $(this).removeClass("autocompleted");
              $(this).addClass("placeholder");
          }
      })

      .autocomplete({
          minLength: 2,
          source: function (request, response) {
              $.ajax({
                  url: '/ratteries/autocomplete.json',
                  dataType: 'json',
                  data: {
                      'searchkey': $(visible).val(),
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
              $(visible).val(ui.item.value); // display the selected text
              $(visible).addClass("autocompleted"); // display the selected text
              $(hidden).val(ui.item.id); // save selected id to hidden input
          }
        }
    );
}
