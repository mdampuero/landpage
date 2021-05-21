(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 56)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 57
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    // console.log($("#mainNav").offset().top);
    if ($("#mainNav").offset().top > 100) {
      $("#navBarTop").hide();
      $("#navBarFixed").show();
    } else {
      $("#navBarTop").show();
      $("#navBarFixed").hide();
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Scroll reveal calls
  window.sr = ScrollReveal();

  sr.reveal('.sr-icon-1', {
    delay: 200,
    scale: 0
  });
  sr.reveal('.sr-icon-2', {
    delay: 400,
    scale: 0
  });
  sr.reveal('.sr-icon-3', {
    delay: 600,
    scale: 0
  });
  sr.reveal('.sr-icon-4', {
    delay: 800,
    scale: 0
  });
  sr.reveal('.sr-button', {
    delay: 200,
    distance: '15px',
    origin: 'bottom',
    scale: 0.8
  });
  sr.reveal('.sr-contact-0', {
    delay: 100,
    scale: 0
  });
  sr.reveal('.sr-contact-1', {
    delay: 200,
    scale: 0
  });
  sr.reveal('.sr-contact-2', {
    delay: 300,
    scale: 0
  });
  sr.reveal('.sr-contact-3', {
    delay: 400,
    scale: 0
  });
  sr.reveal('.sr-contact-4', {
    delay: 500,
    scale: 0
  });
  sr.reveal('.sr-contact-5', {
    delay: 600,
    scale: 0
  });
  sr.reveal('.sr-contact-6', {
    delay: 700,
    scale: 0
  });
  sr.reveal('.sr-contact-7', {
    delay: 800,
    scale: 0
  });
  sr.reveal('.sr-contact-8', {
    delay: 900,
    scale: 0
  });
  sr.reveal('.sr-contact-9', {
    delay: 1000,
    scale: 0
  });
  

  // Magnific popup calls


})(jQuery); // End of use strict
