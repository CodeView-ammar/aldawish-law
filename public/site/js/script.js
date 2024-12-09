$(window).on('load', function() {
    $(".preloader").fadeOut();

  });
  $(document).ready(function() {
    new WOW().init();

    //phone size menu onclick
    if ($(window).width() <= 1280) {
        $("#menu-id").click(function(e) {
            e.preventDefault();
            $('.menu-bars .bar').toggleClass('hide-icon');
            $('.menu-bars .times').toggleClass('hide-icon');
            $(".navgition").toggleClass("reset-left");
            $("body").toggleClass("overflow");
            $("html").toggleClass("overflow");

        });
        $(".nav-head .close-btn").click(function() {
            $(".navgition").removeClass("reset-left");
            $(".menu-bars .bars").toggleClass("open-bars");
            $(".menu-bars .bars").toggleClass("close-bars");
            $("body").removeClass("overflow");
            $("html").removeClass("overflow");
        });




        //slide down menu
        $(".menu-item-has-children a").click(function(e) {
            // e.preventDefault(e);
            $(this).siblings(".sub-menu ").slideToggle(400);
          //   $(".menu-item-has-children a").not(this).siblings(".sub-menu ").slideUp(400);
          if ($(window).width() <= 1280) {
                $(this).toggleClass("active");
                $(".menu-item-has-children a").not(this).removeClass("active");
            }
        });

    };

    //fixed nav
    $stickyNav = $(".top-header");
    $(window).scroll("scroll load", function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 112) {
            $stickyNav.addClass("fixed-nav", 500);
        } else {
            $stickyNav.removeClass("fixed-nav", 500);
        }
        if (scroll == 0) {
            $stickyNav.removeClass("fixed-nav", 500);
        }
    });
    var $stickyheader = $("header");
    lastScroll = 0;
    $(window).scroll("scroll load", function() {
        var scroll = $(window).scrollTop();
        if (lastScroll - scroll > 0) {
            $stickyheader.addClass("fixed-header", {
                duration: 1000
            });
        } else if (lastScroll - scroll >= 0 && $(window).width() <= 991) {
            $stickyheader.addClass("fixed-header", {
                duration: 1000
            });
        } else {
            $stickyheader.removeClass("fixed-header", {
                duration: 500
            });
        }
        lastScroll = scroll;
        if (scroll == 0) {
            $stickyheader.removeClass("fixed-header", {
                duration: 500
            });
        }
    });




      /// ////// ** main-slider** /////////
      const specials = new Swiper('.main-slider .swiper-container', {
          loop: true,
          autoplay: true,
          pagination: {
              el: '.main-slider .swiper-pagination',
              clickable: true,
          },
          navigation: {
              nextEl: '.main-slider .swiper-btn-next',
              prevEl: '.main-slider .swiper-btn-prev',
          },
          breakpoints: {
              0: {
                  slidesPerView: 1,
              },
              767: {
                  slidesPerView: 1,
              },
              992: {
                  slidesPerView: 1,
              },
              1199: {
                  slidesPerView: 1,
              },
          },
      });









   ///////// **partners-swiper-section** /////////
   var screen2 = new Swiper(".partners .swiper-container", {
      loop: true,
      autoplay: true,
      pagination: {
          el: ".partners .swiper-pagination",
          clickable: true,
      },
      navigation: {
          nextEl: ".partners .swiper-btn-next",
          prevEl: ".partners .swiper-btn-prev",
      },
      breakpoints: {
          0: {
              slidesPerView: 3,
              spaceBetween: 15,
          },
          767: {
              slidesPerView: 4,
              spaceBetween: 15,
          },

          992: {
              slidesPerView: 5,
              spaceBetween: 30,
          },
          1199: {
              slidesPerView: 6,
              spaceBetween: 30,
          },
      },
  });

  /////////////////////////// toggle check faq //////////////////////
        // http://stackoverflow.com/a/9762070/938089?why-is-the-selector-not-working

        $(".accordion__title").click(function(event) {
          var radio_selector = 'input[type="radio"]',
              $radio;

          // Ignore the event when the radio input is clicked.
          if (!$(event.target).is(radio_selector)) {
              $radio = $(this).find(radio_selector);
              // Prevent the event to be triggered
              // on another element, for the same click
              event.stopImmediatePropagation();
              // We manually check the box, so prevent default
              event.preventDefault();
              $radio.prop('checked', !$radio.is(':checked'));
          }
      });
      $(".accordion__title input").on('change click', function(event) {
          // The change event only fires when the checkbox state changes
          // The click event always fires

          // When the radio is already checked, this event will fire only once,
          // resulting in an unchecked checkbox.
          // When the radio is not checked already, this event fires twice
          // so that the state does not change
          this.checked = !this.checked;
      })


    //////////** fixed arrow to top**//////////
    $(".arrow-top").click(function() {
        $("html,body").animate({
                scrollTop: 0,
                behavior: 'smooth'
            },
            20
        );
    });
    $(this).scrollTop() >= 500 ?
        $(".arrow-top").fadeIn(300) :
        $(".arrow-top").fadeOut(300);

    $(window).scroll(function() {
        $(this).scrollTop() >= 500 ?
            $(".arrow-top").fadeIn(300) :
            $(".arrow-top").fadeOut(300);
    })


    $(".inputs").keyup(function () {
      if (this.value.length == this.maxLength) {
        var $next = $(this).next('.inputs');
        if ($next.length)
            $(this).next('.inputs').focus();
        else
            $(this).blur();
      }
  });

      ////////////** counter  *///////////////////////////////
      var ax = 0;
      $(window).scroll(function() {

          var oTop = $('#counter').offset().top - window.innerHeight;
          // Md.Asaduzzaman Muhid
          if (ax == 0 && $(window).scrollTop() > oTop) {
              $('.counter-number').each(function() {
                  var $this = $(this);
                  jQuery({
                      Counter: 0
                  }).animate({
                      Counter: $this.text()
                  }, {
                      duration: 2000,
                      easing: 'swing',
                      step: function() {
                          $this.text(Math.ceil(this.Counter));
                      }
                  });
              });
              ax = 1; // Md.Asaduzzaman Muhid
          }
      });


  });
