jQuery(document).ready(function($) {

    "use strict";

    $('.homepage-slider').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        loop: true,
        pager: true,
        auto: true,
        speed: 1000,
        pause: 4200,
        enableDrag: false,
        controls: false,
        onSliderLoad: function() {
            $('.homepage-slider').removeClass('cS-hidden');
        }
    });

    /**
     * Testimonilas slider
     */
    $('.testimonialsSlider').lightSlider({
        item: 1,
        slideMargin: 0,
        loop: true,
        controls: false,
        auto: false,
        speed: 700,
        pause: 4200,
        enableDrag: false,
        onSliderLoad: function() {
            $('.testimonialsSlider').removeClass('cS-hidden');
        }
    });

    // toggle-menu
    $('.menu-toggle').click(function(event) {
        $('#primary-menu').slideToggle('slow');
    });

    //responsive sub menu toggle
    $('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

    $('#site-navigation .sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
    });

    // search js
    $('.header-search-wrapper .search-main').click(function() {
        $('.header-search-wrapper .search-form-main').addClass('active');
        $('.header-search-wrapper .search-form-main .search-field').focus();
    });

    $('.header-search-wrapper .close').click(function() {
        $('.header-search-wrapper .search-form-main').removeClass('active');
    });


    // Scroll To Top
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('#mt-scrollup').fadeIn('slow');
        } else {
            $('#mt-scrollup').fadeOut('slow');
        }
    });

    $('#mt-scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    //edd wrap

    $(".edd_download_inner").each(function() {
        $(this).find("div, h3").not('.edd_download_image').wrapAll('<div class="edd-extra-wrapper"></div>');
    });
});
