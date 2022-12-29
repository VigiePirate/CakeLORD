function autocompleteRattery(visible, hidden) {
    $(visible).autocomplete({
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
              $(hidden).val(ui.item.id); // save selected id to hidden input
          }
      });

      $(visible).on("input", function(){
          $(hidden).val('');
      });
}
