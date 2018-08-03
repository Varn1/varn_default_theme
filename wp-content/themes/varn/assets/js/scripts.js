(function($){
  //on menu click
  function openclose() {
    if($('.hamburger').hasClass('open')){
      $('.hamburger, .overlay, .overlay-footer, .mobile-menu, .move').removeClass('open');
    } else {
      $('.hamburger, .overlay, .overlay-footer, .mobile-menu, .move').addClass('open');
    }
  }

  function stopProp(event, element) {
    // Don't propogate the event to the document
    if (event.stopPropagation) {
      event.stopPropagation();   // W3C model
    } else {
      event.cancelBubble = true; // IE model
    }
  }

  $('#mobile-menu-button').on('click', function(event){
    if (event.stopPropagation){
      event.stopPropagation();
    }
    else if(window.event){
      window.event.cancelBubble=true;
    }
    openclose();
  });

  function outsideClick() {
    if($('.hamburger').hasClass('open')) {
      openclose();
    }
  }

  $('html').on('click', function(event){
    outsideClick();
  });



})(jQuery);
