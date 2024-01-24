// preloder
$(window).on('load',function(){
  $('.preloder').delay(1000).fadeOut(100);
})


const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);
// Feature slider

$(document).ready(function () {
  // Background Image
  $("[data-background]").each(function () {
    $(this).css(
      "background-image",
      "url(" + $(this).attr("data-background") + ")"
    );
  });
  $(".featured-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    centerMode: true,
    centerPadding: "60px",
    asNavFor: ".slider-nav",
  });

  $(".slider-nav").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: ".featured-slider",
    dots: false,
    focusOnSelect: true,
    arrows: false,
  });
  $(".plan-slider").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 5,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 376,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
  // Review
  $(".review-carousel").slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: "10px",
    prevArrow:
      '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
    nextArrow:
      '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    arrows: false,
    dots: true,
    // autoplay: true,
    responsive: [
      {
        breakpoint: 1200,
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

  //Related Products
  $(".related-product").slick({
    infinite: true,
    slidesToShow: 3,
    arrows: true,
    dots: false,
    autoplay: true,
    slidesToScroll: 1,
    prevArrow:
      '<button class="slick-arrow slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
    nextArrow:
      '<button class="slick-arrow slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
  $(".related-product-2").slick({
    infinite: true,
    slidesToShow: 4,
    arrows: true,
    dots: false,
    autoplay: false,
    slidesToScroll: 1,
    prevArrow:
      '<button class="slick-arrow slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
    nextArrow:
      '<button class="slick-arrow slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  // Total Price
  var output = document.querySelectorAll("output")[0];
  $(document).on("input", '#calc-price input[type="range"]', function (e) {
    output.innerHTML = e.currentTarget.value;
  });
  $("#calc-price input[type=range]").rangeslider({
    polyfill: false,
  });

  var output1 = document.querySelectorAll("output1")[0];
  $(document).on("input", '#load-period input[type="range"]', function (e) {
    output1.innerHTML = e.currentTarget.value;
  });
  $("#load-period input[type=range]").rangeslider({
    polyfill: false,
  });

  // Total Price
  var output3 = document.querySelectorAll("output3")[0];
  $(document).on("input", '#calc-down input[type="range"]', function (e) {
    output3.innerHTML = e.currentTarget.value;
  });
  $("#calc-down input[type=range]").rangeslider({
    polyfill: false,
  });

  // Total Price
  var output4 = document.querySelectorAll("output4")[0];
  $(document).on("input", '#calc-interest input[type="range"]', function (e) {
    output4.innerHTML = e.currentTarget.value;
  });
  $("#calc-interest input[type=range]").rangeslider({
    polyfill: false,
  });

  $(".product-carousel").slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow:
      '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
    nextArrow:
      '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    arrows: false,
    dots: true,
    autoplay: true,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 376,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
});

