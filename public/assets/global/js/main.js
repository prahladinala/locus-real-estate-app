$("document").ready(function () {
    'use strict';
    $(".toggle-icon").on('click', function () {
        $(".menu-items").addClass("open");
        $(this).hide();
        $(".crose-icon").show();
    })
    $(".crose-icon").on('click', function () {
        $(".menu-items").removeClass("open");
        $(this).hide();
        $(".toggle-icon").show();
    })

    // Wishlist Active
    $('.wishlist').on('click', function () {
        $(this).toggleClass('active-color');
    })
    $('.s-heart').on('click', function () {
        $(this).toggleClass('active-color');
        $("this").text("click");
    })


    // WoW Js
    new WOW().init();


    //   Sub Header Search
    $('.tablet-search').on('click', function () {
        $('.real-estate-search').addClass('active');
        $(this).hide();
        $('.tab-crose').show();
    })
    $('.tab-crose').on('click', function () {
        $('.real-estate-search').removeClass('active');
        $(this).hide();
        $('.tablet-search').show();
    })
    // Sidebar Show
    $(".filter-area i").on('click', function () {
        $(".sidebar-content").toggleClass("active");
        var sliders = document.querySelectorAll('.min-max-slider');
        sliders.forEach(function (slider) {
            init(slider);
        });
    });

    // All Feature Slider
    $('.all-feature').owlCarousel({
        loop: true,
        autoplay: true,
        dots: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            1024: {
                items: 5
            }
        }
    })
    // City Post Slider
    $('.city-card-group').owlCarousel({
        loop: true,
        margin: 24,
        autoplay: true,
        dots: false,
        nav: true,
        navText: ['<i class="fa-solid fa-left-long"></i>', '<i class="fa-solid fa-right-long"></i>'],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 2
            },
            1024: {
                items: 4
            }
        }
    })

    // Testimonials Carousel Slick
    $(".testimonials-carousels").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: "10px",
        arrows: false,
        dots: true,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 5,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    centerMode: false,
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    centerMode: false,
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 376,
                settings: {
                    centerMode: false,
                    slidesToShow: 1,
                },
            },
        ],
    });
    // Client All
    $('.client-all').owlCarousel({
        loop: true,
        margin: 24,
        autoplay: true,
        dots: false,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            1024: {
                items: 5
            }
        }
    })
    $('.testimonials-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        dots: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            1024: {
                items: 3
            }
        }
    })

    // Nice Select
    $('.nice-control').niceSelect();

    $('.mega-menu-toggle').on('click', function () {
        $('.mega-filter-area').addClass('active')
        $('.mega-menu-toggle').addClass('active');
    })
    $('.mega-crose').on('click', function () {
        $('.mega-filter-area').removeClass('active')
        $('.mega-menu-toggle').removeClass('active');
    })


    // Large Image Slider
    $(".veiw-large-slides").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        centerMode: true,
        arrow: true,
        autoplay: true,
        centerPadding: "60px",
        asNavFor: ".small-img-slide",
    });

    $(".small-img-slides").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: ".veiw-large-slide",
        dots: false,
        focusOnSelect: true,
        arrows: false,
        autoplay: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });


    // Client All
    $('.floor-area').owlCarousel({
        loop: false,
        autoplay: true,
        dots: false,
        nav: true,
        navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 4
            },
            1024: {
                items: 4
            }
        }
    })
    // Client All
    $('.related-pro-areas').owlCarousel({
        loop: true,
        autoplay: true,
        dots: false,
        nav: true,
        navText: ['<i class="fa-solid fa-left-long"></i>', '<i class="fa-solid fa-right-long"></i>'],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            1024: {
                items: 4
            }
        }
    })

    //  Gallary Image ZoomUp
    new VenoBox({
        selector: '.veno-img',
        numeration: true,
        navigation: true,
        infinigall: true,
        share: true,
        navTouch: true,
        spinner: "rotating-plane",
    });

    // Vedio Paralax Magnific Popup
    $('#vedio-popup').magnificPopup({
        type: 'iframe',
        iframe: {
            markup: '<div class="mfp-iframe-scaler">' +
                '<div class="mfp-close"></div>' +
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                '</div>',

            patterns: {
                youtube: {
                    index: 'youtube.com/',

                    id: 'v=',

                    src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: '/',
                    src: 'https://player.vimeo.com/video/%id%?autoplay=1'
                },
                gmaps: {
                    index: '//maps.google.',
                    src: '%id%&output=embed'
                }

            },

            srcAction: 'iframe_src',
        }

    });

    // Flat Datepiker
    $("#flat").flatpickr({
        enableTime: true,
        dateFormat: "d M Y h:i K",

    });
    // Floor Image Popup
    $('.single-floor').magnificPopup({
        type: 'image',
        delegate: 'a',
        gallery: {
            enabled: true
        }
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();


});

