

if($(window).innerWidth() >= 1024){
    new WOW().init();
}
$(document).ready(function() {

    //back top top
    if ($('#back-to-top').length) {
        var scrollTrigger = 800,
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');

                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });

        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
})
$('.slider-banner').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    arrow: true,
    prevArrow: '<button class="previous"><i class="fa fa-angle-left"></i> </button>',
    nextArrow: '<button class="next"><i class="fa fa-angle-right"></i> </button>',
    centerPadding: 0,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1
});


$('.slide-news-ind .row').slick({
    autoplay: true,
    autoplaySpeed: 1500,
    arrow: true,
    centerPadding: 0,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<button class="previous"><i class="fa fa-angle-left"></i> </button>',
    nextArrow: '<button class="next"><i class="fa fa-angle-right"></i> </button>',
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            }
        }
        ]
});

$('.other .list-news .row').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    arrow: true, 
    centerPadding: 0,
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    // prevArrow: '<button class="previous"><i class="fa fa-chevron-left"></i> </button>',
    // nextArrow: '<button class="next"><i class="fa fa-chevron-right"></i> </button>',
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
});

$('.list-other-proj .row').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    arrow: true, 
    centerPadding: 0,
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<button class="previous"><i class="fa fa-angle-left"></i> </button>',
    nextArrow: '<button class="next"><i class="fa fa-angle-right"></i> </button>',
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
});

$('.list-feed-back .row').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    arrow: false, 
    centerPadding: 0,
    dots: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    // prevArrow: '<button class="previous"><i class="fa fa-angle-left"></i> </button>', 
    // nextArrow: '<button class="next"><i class="fa fa-angle-right"></i> </button>', 
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
});

$('.list-part .row').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    arrow: true, 
    centerPadding: 0,
    dots: false,
    slidesToShow: 6,
    slidesToScroll: 1,
    prevArrow: '<button class="previous"><i class="fa fa-angle-left"></i> </button>',  
    nextArrow: '<button class="next"><i class="fa fa-angle-right"></i> </button>',  
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 6,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            }
        }
        ]
});

$('.other-prod .row').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    arrow: true, 
    centerPadding: 0,
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<button class="previous"><i class="fa fa-angle-left"></i> </button>',
    nextArrow: '<button class="next"><i class="fa fa-angle-right"></i> </button>',
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
});

$(document).ready(function(){
  $('.pagination ul li a, .header-menu ul li a').click(function(){
    $('.pagination ul li a, .header-menu ul li a').removeClass("active");
    $(this).addClass("active");
  });
});

var numberSpinner = (function() {
  $('.number-spinner>.ns-btn>a').click(function() {
    var btn = $(this),
      oldValue = btn.closest('.number-spinner').find('input').val().trim(),
      newVal = 0;

    if (btn.attr('data-dir') === 'up') {
      newVal = parseInt(oldValue) + 1;
    } else {
      if (oldValue > 1) {
        newVal = parseInt(oldValue) - 1;
      } else {
        newVal = 1;
      }
    }
    btn.closest('.number-spinner').find('input').val(newVal);
  });
  $('.number-spinner>input').keypress(function(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  });
})();


var dropdowns = $(".dropdown");
dropdowns.find("dt").click(function(){
    dropdowns.find("dd ul").hide();
    $(this).next().children().toggle();
});
dropdowns.find("dd ul li a").click(function(){
    var leSpan = $(this).parents(".dropdown").find("dt a span");
    $(this).parents(".dropdown").find('dd a').each(function(){
    $(this).removeClass('selected');
  });
    leSpan.html($(this).html());
    if($(this).hasClass('default')){
    leSpan.removeClass('selected')
  }
    else{
        leSpan.addClass('selected');
        $(this).addClass('selected');
    }
    $(this).parents("ul").hide();
});
$(document).bind('click', function(e){
    if (! $(e.target).parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$("a.sub-cate").click(function() {    
    $(this).parents().children('.box-side ul ul').toggle();
    $(this).toggleClass('active');
  });


$('.slider-for').slick({
    autoplay: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav',
});
$('.slider-nav').slick({
    autoplay:false,
    arrow:false,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1
            }
        }
    ],
    asNavFor: '.slider-for',
    dots: false,
    centerMode: true,
    centerPadding: 0,
    focusOnSelect: true,
    prevArrow: '<span class="previous"><i class="fa fa-chevron-left"></i></span>', 
    nextArrow: '<span class="next"><i class="fa fa-chevron-right"></i></span>', 
});

$(function() {
  $("#price-range").slider({range: true, min: 100000, max: 10000000, values: [100000, 10000000], slide: function(event, ui) {$("#priceRange").val("$" + ui.values[0] + " - $" + ui.values[1]);}
  });
  $("#priceRange").val($("#price-range").slider("values", 0) + " - " + $("#price-range").slider("values", 1));
  
  $("#mpg-range").slider({range: true, min: 10, max: 100, values: [0, 100], slide: function(event, ui) {$("#MPGRange").val(ui.values[0] + " - " + ui.values[1]);}
  });
  $("#MPGRange").val($("#mpg-range").slider("values", 0) + " - " + $("#mpg-range").slider("values", 1));
  
  $("#mileage-range").slider({range: true, min: 0, max: 200000, values: [0, 200000], slide: function(event, ui) {$("#mileageRange").val(ui.values[0] + " - " + ui.values[1]);}
  });
  $("#mileageRange").val($("#mileage-range").slider("values", 0) + " - " + $("#mileage-range").slider("values", 1));
});


jQuery(document).ready(function( $ ) {
  $("#menu").mmenu({
     "extensions": [
        "fx-menu-zoom"
     ],
     "counters": true
  });
});