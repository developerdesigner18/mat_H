(function($) {
    'use strict';

    var counter = function() {
        $('.master-counter').each(function() {
            var $this = $(this);

            $this.appear(function() {
                $this.find('.number').countTo();
            });
        });
    };

    var progressBar = function() {
        $('.master-progress-bar').each(function() {
            var
            t = $(this),
            v = t.find(".progress"),
            p = v.data('percent');

            t.appear(function() {
                v.css({
                    'width': p
                }, "slow");
            });
        });
    };

     var popupVideo = function() {
        $('.popup-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: true
        });
    };

    var inViewport =  function() {
        $('[data-in-viewport="true"]').appear(function() {
            $(this).addClass('is-in-view');
        });
    };

    var tabs = function() {
        $('.master-tabs').each(function() {
            var t = $(this),
            percent = ((100 / t.find('.tab-link').length));
            percent = percent.toFixed(2);

            t.find('.tab-link-wrap li').css('max-width', (percent + '%')).first().addClass('active');
            t.find('.tab-content').first().addClass('active');
        });

        $('.tab-link-wrap li').on('click', function() {
            var
            t = $(this),
            id = t.attr('data-tab');

            t.addClass('active')
                .siblings().removeClass('active')
                .closest('.master-tabs')
                .find('.tab-content').removeClass('active').hide();
            $("#" + id).addClass('active').fadeIn("slow");
        });
    };

    var parallaxImage = function() {
        $('.master-parallax-box').each(function() {
            var
            p = $(this).find('.parallax-wrap'),
            item = $(this).find(".master-parallax-item");

            function calcHeight(){
                var arr = [];
                $(p).waitForImages(function() {
                    item.each(function() {
                        var t = $(this),
                            top = $(this).data("top"),
                            top_tablet = $(this).data("top-tablet"),
                            top_mobile = $(this).data("top-mobile");

                        if ( matchMedia( 'only screen and (max-width: 1025px)') && ( top_tablet !== 'px' ) )
                            top = top_tablet;

                        if ( matchMedia( 'only screen and (max-width: 767px)' ) && ( top_mobile !== 'px' ) )
                            top = top_mobile;

                        (top == 'px') && (top = '0px');
                        (top == '%') && (top = '0%');

                        if (top.indexOf("%") >= 0) {
                            var total = t.height()/(100 - parseFloat(top))*100;
                            arr.push(total);
                        } else {
                            arr.push(parseInt(top) + t.height());
                        }
                    });

                    $(p).css("height", Math.max.apply(null, arr));
                });
            }       

            $(window).resize(calcHeight);
            calcHeight();
        })  
    };

    var carouselGallery = function() {
        $(".master-gallery-carousel").masterCarouselBox();
    }

    var carouselNews = function() {
        $(".master-news-carousel").masterCarouselBox();
    }

    var carouselPartner = function() {
        $(".master-partner-carousel").masterCarouselBox();
    }

    var carouselProject = function() {
        $(".master-project-carousel").masterCarouselBox();
    }

    var carouselService = function() {
        $(".master-service-carousel").masterCarouselBox();
    }

    var carouselTeam = function() {
        $(".master-team-carousel").masterCarouselBox();
    }

    var carouselTestimonial = function() {
        $(".master-testimonial-carousel").masterCarouselBox();
    }

    var carouselTemplate = function() {
        $(".master-template-carousel").masterCarouselBox();
    }

    var portfolio = function() {
        $(".master-portfolio").masterPortfolio();
    }

    var newsGrid = function() {
        $(".master-news-grid").masterPortfolio();
    }

    var link = function() {
        $(".master-link").masterLink();
    }

    var icon = function() {
        $(".master-icon").masterIcon();
    }

    var stretch = function() {
        $('.stretch').each(function() {
            var t = $(this);
       
            function calcSize(){
                $(t).waitForImages(function() {
                    var
                    a = $(window).width(),
                    b = t.width(),
                    c = t.offset().left;
                    
                    if (t.is('.stretch-right')) {
                        var d = - (a - (b + c));
                        if (d < -20)
                            t.css('margin-right', d + 'px');
                    }

                    if (t.is('.stretch-left')) {
                        var d = -c;
                        if (d < -20)
                            t.css('margin-left', d + 'px');
                    }
                });
            } 

            $(window).resize(calcSize);
            calcSize();
        })
    }

    var accordions = function() {
        $('.master-accordions').each( function() {
            var args = {easing:'easeOutExpo', duration:300};

            $(this).children('.item.active').children('.content').show();

            $(this).children('.item').find('.title').on( 'click', function() {
                if ( !$(this).parent().is('.active') ) {
                    $(this).parent().toggleClass('active')
                        .children('.content').slideToggle(args)
                    .parent().siblings('.active').removeClass('active')
                        .children('.content').slideToggle(args);
                } else {
                    $(this).parent().toggleClass('active');
                    $(this).next().slideToggle(args);
                }
            } )
        } )
    }

    var mae_custom_logo = function( newValue ) {
        $('#site-logo img').attr("src", newValue['url']);
    }

    var mae_featured_title_bg = function( newValue ) {
        $('#featured-title').css('background-image', 'url(' + newValue['url'] + ')' );
    }

    var mae_custom_featured_title = function( newValue ) {
        $('#featured-title .main-title').text(newValue);
    }

    var mae_header_extra = function( newValue ) {
        $('#site-header').attr('class', newValue);
    }

    var mae_sidebar = function( newValue ) {
        if ( newValue == 'no-sidebar' ) {
            $('body').removeClass('sidebar-left sidebar-right').addClass('no-sidebar');
        } else {
            $('body').removeClass('no-sidebar sidebar-right sidebar-left').addClass(newValue);
        }
    }

    /**
     * Elementor JS Hooks
     */
    $(window).on("elementor/frontend/init", function() {
        $(window).on("resize", function() {
            stretch();
        })

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-counter.default", counter);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-template-carousel.default", carouselTemplate);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-gallery-carousel.default", carouselGallery);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-service-carousel.default", carouselService);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-team-carousel.default", carouselTeam);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-carousel.default", carouselProject);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-carousel.default", carouselNews);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-partner-carousel.default", carouselPartner);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-testimonial-carousel.default", carouselTestimonial);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-tabs.default", tabs);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-accordions.default", accordions);

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-grid.default", portfolio);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-grid.default", newsGrid);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-progress-bar.default", progressBar);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-video-icon.default", popupVideo);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-fancy-image.default", popupVideo);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-fancy-image.default", stretch);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-fancy-image.default", inViewport);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-parallax-image.default", parallaxImage);


        if ( typeof elementor != "undefined" && typeof elementor.settings.page != "undefined" ) {
            elementor.settings.page.addChangeCallback( 'custom_logo', mae_custom_logo );
        }

        // elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
        //     // Fix header overslap elementor setting
        //     if ( $('body.elementor-preview').length ) {
        //         var 
        //         a = $('#site-header').height(),
        //         b = $('.elementor-inner .elementor-element').first(),
        //         c = b.offset().top,
        //         d = b.find('> .elementor-element-overlay .elementor-editor-element-settings.elementor-editor-section-settings');
        //         if ( a > c )
        //             d.css("margin-top", a - c);
        //     }
        // } );
    
    });


})(jQuery);
