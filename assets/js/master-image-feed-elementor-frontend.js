; (function ($) {
    "use strict";
	
	var editMode = false;


	var MIEL = {
        
        // Instagram Feed
        Instagram_Feed: function ($scope, $) {

            var $instagramWrapper = $scope.find(".jltelimf"),
                $insta_data = $instagramWrapper.data("settings"),
                $insta_carousel_data = $instagramWrapper.data("slider-settings"),
                $insta_lightbox_data = $instagramWrapper.data("lightbox-settings"),
                $layout = $insta_data.layout,
                $gallery = $(this),
                $scope = $(".elementor-element-"+ $insta_data.container_id +"");

                // Carousel Layout
                if($layout == 'carousel'){

                    var $carousel_nav       = $insta_carousel_data.carousel_nav,
                        $loop               = ($insta_carousel_data.loop !== undefined) ? $insta_carousel_data.loop : false,
                        $slidesToShow       = $insta_carousel_data.slidestoshow,
                        $slidesToScroll     = $insta_carousel_data.slidestoscroll,
                        $autoPlay           = ( $insta_carousel_data.autoplay !== undefined) ? $insta_carousel_data.autoplay : false,
                        $autoplaySpeed      = ($insta_carousel_data.autoplayspeed) ? $insta_carousel_data.autoplayspeed : '2400',
                        $transitionSpeed    = $insta_carousel_data.speed,
                        $pauseOnHover       = ($insta_carousel_data.pauseonHover !== undefined) ? $insta_carousel_data.pauseonHover : false,
                        $direction          = $insta_carousel_data.direction;


                    // Instagram Slider Carousel
                    if ($carousel_nav == "arrows") {
                        var arrows = true;
                        var dots = false;
                    } else {
                        var arrows = false;
                        var dots = true;
                    }

                    $("#jltma-instagram-" + $insta_data.container_id).slick({
                        infinite: $loop,
                        rtl: $direction,
                        slidesToShow: $slidesToShow,
                        slidesToScroll: $slidesToScroll,
                        autoplay: $autoPlay,
                        autoplaySpeed: $autoplaySpeed,
                        speed: $transitionSpeed,
                        mobileFirst:true,
                        pauseOnHover: $pauseOnHover,
                        // adaptiveHeight: $adaptiveHeight,
                        dots: dots,
                        arrows: arrows,
                        prevArrow: "<div class='ma-el-team-carousel-prev'><i class='fa fa-angle-left'></i></div>",
                        nextArrow: "<div class='ma-el-team-carousel-next'><i class='fa fa-angle-right'></i></div>",
                        rows: 0,
                        lazyLoad: 'ondemand',
                        touchMove: true,
                        responsive: [
                            {
                                breakpoint: 480,
                                settings: {
                                    dots: dots,
                                    arrow: arrows,
                                    slidesToShow: 1,
                                    rows:1,
                                    slidesPerRow:1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    dots: dots,
                                    arrow: arrows,
                                    slidesToShow: 2,
                                    slidesToScroll: 2
                                }
                            },
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 3,
                                    slidesToScroll: 3,
                                    infinite: true,
                                    centerMode: false,
                                    dots: dots,
                                    arrow: arrows
                                }
                            },
                        ],
                    });


                }


                // Masonry Layout
                if($layout == 'masonry'){
                    var $settings = {
                        itemSelector: ".jltma-instafeed-item",
                        percentPosition: true,
                        masonry: {
                            columnWidth: ".jltma-instafeed-item",
                        }
                    },
                    $instagram_gallery = $(".jltma-instafeed-masonry", $scope).isotope($settings);

                    // layout gallery, while images are loading
                    $instagram_gallery.imagesLoaded().progress(function() {
                        $instagram_gallery.isotope("layout");
                    });

                    $(".jltma-instafeed-item", $gallery).resize(function() {
                        $instagram_gallery.isotope("layout");
                    });
                }

                // console.log( $( "#jltma-instagram-" + $insta_data.container_id + ' .jltma-instafeed-item' ));
                // Lightbox Settings
                if( $insta_data.lightbox  == "enabled"){
                    if ($.isFunction($.fn.fancybox)) {
                        $( "#jltma-instagram-" + $insta_data.container_id + ' .jltma-instafeed-item' ).fancybox({
                            protect: $insta_lightbox_data.protect,
                            animationDuration: 366,
                            transitionDuration: 366,
                            transitionEffect: $insta_lightbox_data.transitionEffect, // Transition effect between slides
                            animationEffect: $insta_lightbox_data.animationEffect,
                            preventCaptionOverlap : $insta_lightbox_data.preventCaptionOverlap,
                            // loop: false,
                            infobar: false,
                            buttons: $insta_lightbox_data.buttons,

                            afterLoad : function(instance, current) {
                                var pixelRatio = window.devicePixelRatio || 1;

                                if ( pixelRatio > 1.5 ) {
                                    current.width  = current.width  / pixelRatio;
                                    current.height = current.height / pixelRatio;
                                }
                            }
                        });
                    }
                }

        }

	}


	// Elementor Addons
    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) { editMode = true; }
        elementorFrontend.hooks.addAction('frontend/element_ready/jltelimf.default', MIEL.Instagram_Feed );
    });
})(jQuery);