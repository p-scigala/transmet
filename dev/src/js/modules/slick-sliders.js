const slickInit = ($) => {

  const prevArrow = `<button type='button' class='slick-prev btn--arrow btn--arrow-left'></button>`;
  const nextArrow = `<button type='button' class='slick-next btn--arrow btn--arrow-right'></button>`;

  if (document.querySelector('.hero__slider')) {
    createBar($('.hero__slider')[0], '');
    createButtons($('.hero__slider')[0], 'wrapper animate delay-15');

    setTimeout(() => {
      $('.hero__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        prevArrow: prevArrow,
        nextArrow: nextArrow,
        variableWidth: false,
        centerMode: false,
        fade: true,
        cssEase: 'linear',
        appendArrows: '.hero .slider__nav',
        responsive: [
          {
            breakpoint: 800,
            settings: {
              arrows: false,
            },
          },
        ],
      });
    }, 100);
  }

  let sliderCount = 1;

  $('.slider').each(function () {
    const withBar = $(this).hasClass('slider--with-bar');
    const withButtons = $(this).hasClass('slider--with-buttons');

    if (withButtons) {
      createButtons($(this)[0], 'animate delay-3', sliderCount);
    }

    if (withBar) {
      createBar($(this)[0], `pagination-bar--center animate delay-3`, sliderCount);
    }

    if ($(this).hasClass('categories__items') || $(this).hasClass('text-and-logos__logos')) {

      $(this).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: withButtons,
        dots: false,
        prevArrow: prevArrow,
        nextArrow: nextArrow,
        variableWidth: true,
        infinite: true,
        centerMode: false,
        cssEase: 'ease-in-out',
        appendArrows: `#slider__nav--${sliderCount}`,
        responsive: [
          {
            breakpoint: 800,
            settings: {
              arrows: false,
              centerMode: true,
            },
          },
        ],
      });
    } else {
      $(this).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: withButtons,
        dots: false,
        prevArrow: prevArrow,
        nextArrow: nextArrow,
        variableWidth: true,
        infinite: true,
        centerMode: false,
        cssEase: 'ease-in-out',
        appendArrows: `#slider__nav--${sliderCount}`,
        responsive: [
          {
            breakpoint: 800,
            settings: {
              arrows: false,
            },
          },
        ],
      });
    }

    sliderCount++;
  });

  $(document).ready(function () {
    var $sliders = $('.slider--with-bar');
    $sliders.each(function () {
      initSliderWithProgressBar($(this));
    });
  });

  window.addEventListener('resize', function () {
    var $sliders = $('.slider--with-bar');
    $sliders.each(function () {
      initSliderWithProgressBar($(this));
    });
  });

  function initSliderWithProgressBar($slider) {
    // if (vw <= 800) {
    //   var progressTrackWidth = 246;
    //   var progressBarWidth = 200;
    // } else if (vw > 800 && vw <= 1024) {
    //   var progressTrackWidth = 270;
    //   var progressBarWidth = 170;
    // } else {
    var progressTrackWidth = 204;
    var progressBarWidth = 87;
    // }

    var $progressTrack = $slider.parent().find('.pagination-bar__progress');
    var $progressBar = $progressTrack.find('.pagination-bar__progress-bar');
    // var progressTrackWidth = $progressTrack.width() | 529;
    // var progressBarWidth = $progressBar.width() | 243;
    var maxOffset = progressTrackWidth - progressBarWidth;
    var isDragging = false;
    var startX, startLeft;

    // Aktualizacja paska przy zmianie slajdu
    $slider.on(
      'init reInit afterChange',
      function (event, slick, currentSlide) {
        updateProgress(currentSlide, slick.slideCount);
      }
    );

    function updateProgress(currentSlide, totalSlides) {
      var newLeft = (maxOffset / (totalSlides - 1)) * currentSlide;
      $progressBar.css('transform', `translateX(${newLeft}px)`);
    }

    // Obsługa przeciągania
    $progressBar.on('mousedown touchstart', function (e) {
      e.preventDefault();
      isDragging = true;
      startX = e.pageX || e.originalEvent.touches[0].pageX;
      startLeft = parseFloat($progressBar.css('transform').split(',')[4]) || 0;
      $progressBar.css('transition', 'none'); // Wyłącz animację podczas przeciągania
    });

    $(document).on('mousemove touchmove', function (e) {
      // e.preventDefault(); // Zapobiegaj przewijaniu strony podczas przeciągania
      if (!isDragging) return;
      var moveX = (e.pageX || e.originalEvent.touches[0].pageX) - startX;
      var newLeft = Math.min(Math.max(startLeft + moveX, 0), maxOffset);
      $progressBar.css('transform', `translateX(${newLeft}px)`);
      $progressBar.css('transition', 'none'); // Wyłącz animację podczas przeciągania
    });

    $(document).on('mouseup touchend', function () {
      if (!isDragging) return;
      isDragging = false;
      $progressBar.css('transition', ''); // Wyłącz animację podczas przeciągania

      // Oblicz najbliższy slajd na podstawie pozycji paska
      var percent =
        parseFloat($progressBar.css('transform').split(',')[4]) / maxOffset;
      var totalSlides = $slider.slick('getSlick').slideCount;
      var newSlide = Math.round(percent * (totalSlides - 1));

      // Przejdź do wybranego slajdu
      $slider.slick('slickGoTo', newSlide);
    });

    /* add opacity to every slider item except the one with mouse over */
    $slider
      .find('.panel--main, .panel--news, .panel--plan')
      .on('mouseover', function () {
        $(this).siblings().addClass('opacity-50');
      });
    $slider
      .find('.panel--main, .panel--news, .panel--plan')
      .on('mouseout', function () {
        $(this).siblings().removeClass('opacity-50');
      });
  }





  $('.product-gallery__slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    arrows: true,
    prevArrow: prevArrow,
    nextArrow: nextArrow,
    infinite: true,
    asNavFor: '.product-gallery__slider-nav',
  });

  $('.product-gallery__slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.product-gallery__slider',
    dots: false,
    focusOnSelect: true,

    infinite: true,
    variableWidth: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 2,
          arrows: false,
          //variableWidth: false,
        },
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 2,
          arrows: false,
          //variableWidth: false,
        },
      },
    ],
  });

  $('.product-gallery__slider').on('beforeChange', function () {
    $('.youtube').each(function () {
      $(this).empty().append('<div class="play-button"></div>'); // Usuwa iframe i przywraca przycisk
    });
  });

  // Obsługa kliknięcia, aby ponownie wczytać wideo
  $(document).on('click', '.youtube .play-button', function () {
    var container = $(this).parent();
    var videoId = container.data('id');

    var iframe =
      '<iframe width="560" height="315" src="https://www.youtube.com/embed/' +
      videoId +
      '?autoplay=1" frameborder="0" allowfullscreen></iframe>';

    container.empty().append(iframe); // Dodaje iframe z autoplay
  });

  const slickNav = document.querySelector('.product-gallery__slider-nav');
  if (slickNav) {
    const track = slickNav.querySelector('.slick-track');
    if (track) {
      if (!track.hasChildNodes()) {
        slickNav.style.display = 'none';
        document.querySelector('.single-product__category-name').style.marginTop = '0';
      }
    }
  }





  function createBar(slider, classes, id = '') {
    const paginationBar = document.createElement('div');
    paginationBar.className = 'pagination-bar ' + classes;
    if (id) paginationBar.id = `pagination-bar--${id}`;

    const paginationProgress = document.createElement('div');
    paginationProgress.className = 'pagination-bar__progress';
    paginationBar.appendChild(paginationProgress);

    const paginationProgressBar = document.createElement('div');
    paginationProgressBar.className = 'pagination-bar__progress-bar';

    paginationProgress.appendChild(paginationProgressBar);

    slider.after(paginationBar);
  }

  function createButtons(slider, classes, id = '') {
    const buttonWrapper = document.createElement('div');
    buttonWrapper.className = 'slider__nav-wrapper ' + classes;

    const buttonNav = document.createElement('div');
    buttonNav.className = 'slider__nav';
    if (id) buttonNav.id = `slider__nav--${id}`;

    buttonWrapper.appendChild(buttonNav);
    slider.after(buttonWrapper);
  }
}

export default slickInit;