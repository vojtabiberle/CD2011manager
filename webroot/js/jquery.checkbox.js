(function($) {$.fn.checkbox = function(settings) {
  settings = $.extend({
    loading: true,
    limg: 'load.gif'
    }, settings);
  $(this).click(function() {
      var box = $(this);
      var checked = $(this).is(':checked');
      var name = $(this).attr('name');
      var str = name+'='+ checked;
      var flash = box.next("#flash");
          if (settings.loading) {
             box.hide();
             flash.fadeIn(400).html('<img src="' + settings.limg +'" >');
          }
      $.ajax({
        type: 'POST',
        data: str,
        url: settings.url,
        success: function() {
          if (settings.loading) {
              box.show();
              flash.hide();
          }
       }
      });
     });
};})(jQuery);
