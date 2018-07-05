(function($) {
    "use strict";
    /*-- Menu Sticky --*/
    var $window = $(window);
    $window.on('scroll', function() {
        var scroll = $window.scrollTop();
        if (scroll < 150) {
            $(".sticker").removeClass("stick");
        } else {
            $(".sticker").addClass("stick");
        }
    });
    /*-- Mobile Menu --*/
    var $menu = $("#main-menu").clone().prependTo( "body" );
    $menu.removeAttr( "id" );
    $menu.removeAttr( "class" );
    $menu.find( "[id]" ).removeAttr( "id" );
    $menu.find( "[class]" ).removeAttr( "class" );

    $menu.mmenu();

    var $icon = $("#hamburger .hamburger");
    var API = $menu.data( "mmenu" );

    $icon.on( "click", function() {
       API.open();
    });

    API.bind( "open:finish", function() {
       setTimeout(function() {
          $icon.addClass( "is-active" );
       }, 100);
    });
    API.bind( "close:finish", function() {
       setTimeout(function() {
          $icon.removeClass( "is-active" );
       }, 100);
    });

    /*-- WOW --*/
    new WOW().init();
    /*-- Nivo Slider --*/
    $('#home-slider').nivoSlider({
        directionNav: true,
        animSpeed: 1000,
        effect: 'random',
        slices: 18,
        pauseTime: 5000,
        pauseOnHover: true,
        controlNav: false,
        prevText: '<i class="pe-7s-angle-left-circle"></i>',
        nextText: '<i class="pe-7s-angle-right-circle"></i>'
    });

    var $container = $('div.collection-wrap');
    $container.imagesLoaded(function () {
        $container.isotope({
            itemSelector: '.collection-item',
            layoutMode: 'packery',
            packery: {}
        }).isotope('layout');
    });
    $('div.collection-item .image').hoverdir({
        hoverElem: '.desc'
    });
    /*-- Testimonial Slider --*/
    // $('.testimonial-slider').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     prevArrow: '<button type="button" class="arrow-prev"><i class="pe-7s-angle-left-circle"></i></button>',
    //     nextArrow: '<button type="button" class="arrow-next"><i class="pe-7s-angle-right-circle"></i></button>',
    //     responsive: [{
    //         breakpoint: 767,
    //         settings: {
    //             arrows: false,
    //         }
    //     }, ]
    // });
    /*-- Product Slider 4 Item --*/
    // $('.product-slider-4').slick({
    //     speed: 700,
    //     slidesToShow: 4,
    //     slidesToScroll: 1,
    //     prevArrow: '<button type="button" class="arrow-prev"><i class="pe-7s-angle-left-circle"></i></button>',
    //     nextArrow: '<button type="button" class="arrow-next"><i class="pe-7s-angle-right-circle"></i></button>',
    //     responsive: [{
    //         breakpoint: 991,
    //         settings: {
    //             slidesToShow: 3,
    //         }
    //     }, {
    //         breakpoint: 767,
    //         settings: {
    //             slidesToShow: 2,
    //         }
    //     }, {
    //         breakpoint: 479,
    //         settings: {
    //             slidesToShow: 1,
    //         }
    //     }]
    // });
    /*-- Product Slider 2 Item --*/
    // $('.product-slider-2').slick({
    //     speed: 700,
    //     slidesToShow: 2,
    //     slidesToScroll: 1,
    //     prevArrow: '<button type="button" class="arrow-prev"><i class="pe-7s-angle-left-circle"></i></button>',
    //     nextArrow: '<button type="button" class="arrow-next"><i class="pe-7s-angle-right-circle"></i></button>',
    //     responsive: [{
    //         breakpoint: 991,
    //         settings: {
    //             slidesToShow: 3,
    //         }
    //     }, {
    //         breakpoint: 767,
    //         settings: {
    //             slidesToShow: 2,
    //         }
    //     }, {
    //         breakpoint: 479,
    //         settings: {
    //             slidesToShow: 1,
    //         }
    //     }]
    // });
    /*-- Product Details Thumbnail Slider --*/
    // $('.pro-thumb-img-slider').slick({
    //     speed: 700,
    //     slidesToShow: 4,
    //     slidesToScroll: 1,
    //     prevArrow: '<button type="button" class="arrow-prev"><i class="fa fa-long-arrow-left"></i></button>',
    //     nextArrow: '<button type="button" class="arrow-next"><i class="fa fa-long-arrow-right"></i></button>',
    //     responsive: [{
    //         breakpoint: 991,
    //         settings: {
    //             slidesToShow: 3,
    //         }
    //     }, {
    //         breakpoint: 767,
    //         settings: {
    //             slidesToShow: 3,
    //         }
    //     }, {
    //         breakpoint: 479,
    //         settings: {
    //             slidesToShow: 2,
    //         }
    //     }]
    // })
    /*-- Price Range --*/
    // $('#price-range').slider({
    //     range: true,
    //     min: 0,
    //     max: 300,
    //     values: [40, 250],
    //     slide: function(event, ui) {
    //         $('.ui-slider-handle:eq(0)').html('<span>' + '$' + ui.values[0] + '</span>');
    //         $('.ui-slider-handle:eq(1)').html('<span>' + '$' + ui.values[1] + '</span>');
    //     }
    // });
    // $('.ui-slider-handle:eq(0)').html('<span>' + '$' + $("#price-range").slider("values", 0) + '</span>');
    // $('.ui-slider-handle:eq(1)').html('<span>' + '$' + $("#price-range").slider("values", 1) + '</span>');
    // /*-- Checkout Form Collapse on Checkbox --*/
    // $('.checkout-form input[type="checkbox"]').on('click', function() {
    //     var $collapse = $(this).data('target');
    //     if ($(this).is(':checked')) {
    //         $('.collapse[data-collapse="' + $collapse + '"]').slideDown();
    //     } else {
    //         $('.collapse[data-collapse="' + $collapse + '"]').slideUp();
    //     }
    // })
    /*-- Youtube Background Video --*/
    $(".youtube-bg").YTPlayer();
    /*-- Text Animation --*/
    $('.tlt').textillate({
        loop: true,
        in: {
            effect: 'fadeInRight',
        },
        out: {
            effect: 'fadeOutLeft',
        },
    });
    /*-- ScrollUp --*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

})(jQuery);
