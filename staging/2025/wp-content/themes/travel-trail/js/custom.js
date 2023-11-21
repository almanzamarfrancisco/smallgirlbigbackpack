jQuery(document).ready(function($){

    var slider_auto, slider_loop, rtl;

    if (travel_trail_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (travel_trail_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (travel_trail_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }


    //banner 3
    $('.site-banner.banner-layout-three .banner-wrapper').owlCarousel({
        items: 3,
        loop: slider_loop,
        autoplay: slider_auto,
        dots: false,
        nav: true,
        margin: 24,
        autoplaySpeed: 800,
        rtl: rtl,
        
        responsive: {
            0: {
                margin: 60,
                items: 1,
            },

            767: {
                margin: 40,
                items: 2,
            },
            992: {
                margin: 24,
                items: 3,
                padding: 0,
            },
        }
    });

});