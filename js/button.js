var toggleFABMenu = function (btn) {
  var $this = btn;
  if ($this.hasClass('active-fab')) {
    $this.removeClass('active-fab');
    $('.fab ul li').each(function(i) {
      var $li = $(this);
      setTimeout(function() {
        $li.removeClass('active-fab');
      }, i*30);
    });
  } else {
    $this.addClass('active-fab');
    $($('.fab ul li').get().reverse()).each(function(i) {
      var $li = $(this);
      setTimeout(function() {
        $li.addClass('active-fab');
      }, i*30);
    });
  }
};

$('.fab').click(function(){
  toggleFABMenu($('.fab'));
});
