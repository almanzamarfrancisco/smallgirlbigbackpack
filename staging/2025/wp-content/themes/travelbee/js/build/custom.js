jQuery(document).ready(function ($) {

    /* Header Search toggle
    --------------------------------------------- */
    $('.header-search .search-toggle').click(function () {
        $(this).siblings('.header-search-wrap').fadeIn();
        $('.header-search-wrap form .search-field').focus();
    });

    $('.header-search .close').click(function () {
        $(this).parents('.header-search-wrap').fadeOut();
    });

    $('.header-search-wrap').keyup(function (e) {
        if (e.key == 'Escape') {
            $('.header-search .header-search-wrap').fadeOut();
        }
    });
    $('.header-search .header-search-inner .search-form').click(function (e) {
        e.stopPropagation();
    });

    $('.header-search .header-search-inner').click(function (e) {
        $(this).parents('.header-search-wrap').fadeOut();
    });

    /* Desktop Navigation
    --------------------------------------------- */
    $('.menu-item-has-children').find('> a').after('<button class="submenu-toggle-btn"><i class="fas fa-caret-down"></i></button>');
    $('.main-navigation').prepend('<button class="close-btn"></button>');
    // $('.site-header:not(.style-five,.style-ten,.style-two,.style-six) .secondary-nav >div').prepend('<button class="close-btn"></button>');
    $('.submenu-toggle-btn').on('click', function () {
        $(this).siblings('.sub-menu').stop().slideToggle();
        $(this).toggleClass('active');
    });

    $('.header-main .toggle-btn').on('click', function () {
        $(this).siblings('.main-navigation').animate({
            width: 'toggle'
        });
    });
    $('.main-navigation .close-btn').on('click', function () {
        $('.main-navigation').animate({
            width: 'toggle'
        });
    });

    /* sticky Navigation
    --------------------------------------------- */
    if ($('.site-header').length) {
        var stickyHeaderHeight = $('.sticky-header').outerHeight();
        if (travelbee_data.sticky == "1") {
            $(window).on('scroll', function () {
                var headerHeight = $('.site-header + div').offset().top;
                if ($(window).scrollTop() > headerHeight) {
                    $('.sticky-header').addClass('is-sticky');
                    $('body').addClass('has-sticky-nav');
                    if ($('#wpadminbar').length) {
                        $('.sticky-header').css('top', adminbarHeight);
                    }
                } else {
                    $(".sticky-header").removeClass("is-sticky");
                    $('body').removeClass('has-sticky-nav');
                }
            });

            $(".single .post.has-meta .article-meta .article-meta-inner").css(
                "top",
                stickyHeaderHeight + 50
            );
            $(".widget-sticky .site-content .widget-area .widget:last-child").css(
                "top",
                stickyHeaderHeight + 50
            );

        }
    }

    /* Mobile Navigation
    --------------------------------------------- */

    var adminbarHeight = $('#wpadminbar').outerHeight();
    if (adminbarHeight) {
        $('.site-header .mobile-header .header-bottom-slide .header-bottom-slide-inner ').css("top", adminbarHeight);
    } else {
        $('.site-header .mobile-header .header-bottom-slide .header-bottom-slide-inner ').css("top", 0);
    }

    $('.sticky-header .toggle-btn,.site-header .mobile-header .toggle-btn-wrap .toggle-btn').click(function () {
        $('body').addClass('mobile-menu-active');
        $('.site-header .mobile-header .header-bottom-slide .header-bottom-slide-inner ').css("transform", "translate(0,0)");
    });
    $('.site-header .mobile-header .header-bottom-slide .header-bottom-slide-inner .container .mobile-header-wrap > .close').click(function () {
        $('body').removeClass('mobile-menu-active');
        $('.site-header .mobile-header .header-bottom-slide .header-bottom-slide-inner ').css("transform", "translate(-100%,0)");
    });

    /*  Navigation Accessiblity
    --------------------------------------------- */
    $(document).on('mousemove', 'body', function (e) {
        $(this).removeClass('keyboard-nav-on');
    });
    $(document).on('keydown', 'body', function (e) {
        if (e.which == 9) {
            $(this).addClass('keyboard-nav-on');
        }
    }); 
    
    $('.nav-menu li a, .nav-menu li .submenu-toggle-btn').on('focus', function () {
        $(this).parents('li').addClass('focus');
    }).blur(function () {
        $(this).parents('li').removeClass('focus');
    });

    /*  Scroll top
    --------------------------------------------- */
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 200) {
            $('.back-to-top').addClass('active');
        } else {
            $('.back-to-top').removeClass('active');
        }
    });

    $('.back-to-top').on('click', function () {
        $('body,html').animate({
            scrollTop: 0,
        }, 600);
    });

    var slider_auto, slider_loop, rtl;

    if (travelbee_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (travelbee_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (travelbee_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }


    /* Banner
    --------------------------------------------- */
    //banner 1
    $('.site-banner.banner-layout-one .banner-wrapper').owlCarousel({
        items: 1,
        loop: slider_loop,
        autoplay: slider_auto,
        dots: false,
        nav: true,
        autoplaySpeed: 800,
        rtl: rtl,
        autoplayTimeout: travelbee_data.speed,
        animateOut: travelbee_data.animation
    });

    /* promo section owl-carousel
    --------------------------------------------- */
    $('.featured-section .featured-wrapper .raratheme-itw-holder').addClass('owl-carousel');
    $('.featured-section .featured-wrapper .raratheme-itw-holder').owlCarousel({
        items: 3,
        margin: 30,
        autoplay: false,
        loop: true,
        rtl: rtl,
        nav: true,
        dots: false,
        autoplaySpeed: 800,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1025: {
                items: 3,
                nav: true
            }
        }
    });

});