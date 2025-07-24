const slickCall = ($) => {
  const prevArrow = `
        <button type="button" class="slick__arrow slick-prev btn btn--arrow btn--arrow-left" title="Poprzedni">
            <span></span>
        </button>`;
  const nextArrow = `
        <button type="button" class="slick__arrow slick-next btn btn--arrow btn--arrow-right" title="Następny">
            <span></span>
        </button>`;

  $('.hero__slick').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 5000,
    arrows: true,
    dots: false,
    prevArrow: prevArrow,
    nextArrow: nextArrow,
    variableWidth: false,
    centerMode: false,
    fade: true,
    cssEase: 'linear',
    // responsive: [
    //   {
    //     breakpoint: 1199,
    //     settings: {
    //       arrows: true,
    //     },
    //   },
    //   {
    //     breakpoint: 991,
    //     settings: {
    //       slidesToShow: 1,
    //       arrows: true,
    //     },
    //   },
    // ],
  });

  $('.categories__slick').slick({
    arrows: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    centerMode: false,
    variableWidth: true,
  });

  $('.newest-products__slick').slick({
    arrows: true,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    centerMode: false,
    variableWidth: true,
    prevArrow: prevArrow,
    nextArrow: nextArrow,
  });

  $('.bestsellers__slick').slick({
    arrows: true,
    dots: false,
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    centerMode: false,
    adaptiveHeight: true,
    prevArrow: prevArrow,
    nextArrow: nextArrow,
  });

  $('.steps__slick').slick({
    mobileFirst: true,
    breakpoint: 1024,
    arrows: false,
    dots: false,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 1025,
        settings: 'unslick',
      },
    ],
  });

  $('.slick-carousel').on('setPosition', function (event, slick) {
    var maxHeight = 0;

    // Iteruj przez każdy .offer_job_item, znajdź najwyższy .offer-list-title w każdym elemencie
    $('.slick-carousel__item').each(function () {
      var currentHeight = $(this).find('.slick-carousel__same-h').height();
      if (currentHeight > maxHeight) {
        maxHeight = currentHeight;
      }
    });

    // Ustaw wysokość wszystkich .offer-list-title na największą wysokość
    $('.slick-carousel__same-h').height(maxHeight);
  });

  $('.slick-carousel').on(
    'beforeChange',
    function (event, slick, currentSlide, nextSlide) {
      // Usuń klasy animacji dla wszystkich elementów przed zmianą slajdu
      $('.slick-carousel__title').removeClass('animated');
      $('.slick-carousel__text').removeClass('animated');
      $('.slick-carousel__btn').removeClass('animated');
      $('.slick-carousel__img-01').removeClass('animated');
      $('.slick-carousel__img-02').removeClass('animated');
      $('.slick-carousel__img-03').removeClass('animated');
      $('.slick-carousel__bg').removeClass('animated');

      $('.slick-carousel__product-bg').removeClass('animated');
      $('.slick-carousel__img-product').removeClass('animated');
      $('.slick-carousel__product').removeClass('animated');
    }
  );

  $('.slick-carousel').on(
    'afterChange',
    function (event, slick, currentSlide, nextSlide) {
      // Dodaj klasy animacji tylko dla bieżącego slajdu po zmianie
      var $currentSlide = $(slick.$slides[currentSlide]);

      $currentSlide.find('.slick-carousel__title').addClass('animated');
      $currentSlide.find('.slick-carousel__bg').addClass('animated');

      setTimeout(function () {
        $currentSlide.find('.slick-carousel__img-03').addClass('animated');
        $currentSlide.find('.slick-carousel__text').addClass('animated');
        $currentSlide.find('.slick-carousel__product-bg').addClass('animated');
      }, 300);

      setTimeout(function () {
        $currentSlide.find('.slick-carousel__btn').addClass('animated');
        $currentSlide.find('.slick-carousel__img-02').addClass('animated');
        $currentSlide.find('.slick-carousel__img-product').addClass('animated');
      }, 600);
      setTimeout(function () {
        $currentSlide.find('.slick-carousel__img-01').addClass('animated');
        $currentSlide.find('.slick-carousel__product').addClass('animated');
      }, 900);
      setTimeout(function () {}, 1500);
      setTimeout(function () {}, 700);
    }
  );

  $('.slick-carousel__title').addClass('animated');
  $('.slick-carousel__bg').addClass('animated');
  setTimeout(function () {
    $('.slick-carousel__img-03').addClass('animated');
    $('.slick-carousel__text').addClass('animated');
    $('.slick-carousel__product-bg').addClass('animated');
  }, 300);
  setTimeout(function () {
    $('.slick-carousel__btn').addClass('animated');
    $('.slick-carousel__img-02').addClass('animated');
    $('.slick-carousel__img-product').addClass('animated');
  }, 600);
  setTimeout(function () {
    $('.slick-carousel__img-01').addClass('animated');
    $('.slick-carousel__product').addClass('animated');
  }, 900);

  $(document).ready(function () {
    var $slider = $('.slick-carousel');
    var $progressBar = $('.slick-carousel__progress-bar');
    var progressTrackWidth = 200;
    var progressBarWidth = 87;
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
      isDragging = true;
      startX = e.pageX || e.originalEvent.touches[0].pageX;
      startLeft = parseFloat($progressBar.css('transform').split(',')[4]) || 0;
      e.preventDefault();
    });

    $(document).on('mousemove touchmove', function (e) {
      if (!isDragging) return;
      var moveX = (e.pageX || e.originalEvent.touches[0].pageX) - startX;
      var newLeft = Math.min(Math.max(startLeft + moveX, 0), maxOffset);
      $progressBar.css('transform', `translateX(${newLeft}px)`);
    });

    $(document).on('mouseup touchend', function () {
      if (!isDragging) return;
      isDragging = false;

      // Oblicz najbliższy slajd na podstawie pozycji paska
      var percent =
        parseFloat($progressBar.css('transform').split(',')[4]) / maxOffset;
      var totalSlides = $slider.slick('getSlick').slideCount;
      var newSlide = Math.round(percent * (totalSlides - 1));

      // Przejdź do wybranego slajdu
      $slider.slick('slickGoTo', newSlide);
    });
  });

  $('.home-cat__wrapper').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 5000,
    arrows: false,
    dots: false,
    prevArrow: prevArrow,
    nextArrow: nextArrow,
    variableWidth: true,
    centerMode: true,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          arrows: false,
        },
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          arrows: false,
        },
      },
    ],
  });
  $(document).ready(function () {
    var $slider = $('.home-cat__wrapper');
    var $progressBar = $('.home-cat__progress-bar');
    var progressTrackWidth = 200;
    var progressBarWidth = 87;
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
      isDragging = true;
      startX = e.pageX || e.originalEvent.touches[0].pageX;
      startLeft = parseFloat($progressBar.css('transform').split(',')[4]) || 0;
      e.preventDefault();
    });

    $(document).on('mousemove touchmove', function (e) {
      if (!isDragging) return;
      var moveX = (e.pageX || e.originalEvent.touches[0].pageX) - startX;
      var newLeft = Math.min(Math.max(startLeft + moveX, 0), maxOffset);
      $progressBar.css('transform', `translateX(${newLeft}px)`);
    });

    $(document).on('mouseup touchend', function () {
      if (!isDragging) return;
      isDragging = false;

      // Oblicz najbliższy slajd na podstawie pozycji paska
      var percent =
        parseFloat($progressBar.css('transform').split(',')[4]) / maxOffset;
      var totalSlides = $slider.slick('getSlick').slideCount;
      var newSlide = Math.round(percent * (totalSlides - 1));

      // Przejdź do wybranego slajdu
      $slider.slick('slickGoTo', newSlide);
    });
  });

  function initSlider() {
    const $slider = $('.opinie__slider');
    const slideCount = $slider.children().length;
    const windowWidth = $(window).width();

    const isSlickInitialized = $slider.hasClass('slick-initialized');

    if (windowWidth <= 991) {
      // Mobile: zawsze inicjalizuj slick, jeśli jeszcze nie jest
      if (!isSlickInitialized) {
        $slider.removeClass('opinie__slider--unslick').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: false,
          autoplaySpeed: 5000,
          arrows: false,
          dots: false,
          variableWidth: true,
          centerMode: true,
        });
      }
    } else {
      // Desktop: tylko jeśli więcej niż 3 slajdy
      if (slideCount > 3) {
        if (!isSlickInitialized) {
          $slider.removeClass('opinie__slider--unslick').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            arrows: false,
            dots: false,
            variableWidth: true,
            centerMode: true,
            responsive: [
              {
                breakpoint: 1199,
                settings: {
                  arrows: false,
                },
              },
              {
                breakpoint: 991,
                settings: {
                  slidesToShow: 3,
                  arrows: false,
                },
              },
            ],
          });
        }
      } else {
        // Jeśli jest slick a nie powinno być – usuń
        if (isSlickInitialized) {
          $slider.slick('unslick');
        }
        $slider.addClass('opinie__slider--unslick');
      }
    }
  }

  // Init on load
  $(document).ready(initSlider);

  // Re-init on resize
  $(window).on('resize', function () {
    initSlider();
  });

  $(document).ready(function () {
    var $slider = $('.opinie__slider');
    var $progressBar = $('.opinie__progress-bar');
    var progressTrackWidth = 200;
    var progressBarWidth = 87;
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
      isDragging = true;
      startX = e.pageX || e.originalEvent.touches[0].pageX;
      startLeft = parseFloat($progressBar.css('transform').split(',')[4]) || 0;
      e.preventDefault();
    });

    $(document).on('mousemove touchmove', function (e) {
      if (!isDragging) return;
      var moveX = (e.pageX || e.originalEvent.touches[0].pageX) - startX;
      var newLeft = Math.min(Math.max(startLeft + moveX, 0), maxOffset);
      $progressBar.css('transform', `translateX(${newLeft}px)`);
    });

    $(document).on('mouseup touchend', function () {
      if (!isDragging) return;
      isDragging = false;

      // Oblicz najbliższy slajd na podstawie pozycji paska
      var percent =
        parseFloat($progressBar.css('transform').split(',')[4]) / maxOffset;
      var totalSlides = $slider.slick('getSlick').slideCount;
      var newSlide = Math.round(percent * (totalSlides - 1));

      // Przejdź do wybranego slajdu
      $slider.slick('slickGoTo', newSlide);
    });
  });

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

  $('.polecane-produkt__slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 5000,
    arrows: false,
    dots: false,
    prevArrow: prevArrow,
    nextArrow: nextArrow,
    variableWidth: true,
    centerMode: true,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          arrows: false,
        },
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          arrows: false,
        },
      },
    ],
  });
  $(document).ready(function () {
    var $slider = $('.polecane-produkt__slider');
    var $progressBar = $('.polecane-produkt__progress-bar');
    var progressTrackWidth = 200;
    var progressBarWidth = 87;
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
      isDragging = true;
      startX = e.pageX || e.originalEvent.touches[0].pageX;
      startLeft = parseFloat($progressBar.css('transform').split(',')[4]) || 0;
      e.preventDefault();
    });

    $(document).on('mousemove touchmove', function (e) {
      if (!isDragging) return;
      var moveX = (e.pageX || e.originalEvent.touches[0].pageX) - startX;
      var newLeft = Math.min(Math.max(startLeft + moveX, 0), maxOffset);
      $progressBar.css('transform', `translateX(${newLeft}px)`);
    });

    $(document).on('mouseup touchend', function () {
      if (!isDragging) return;
      isDragging = false;

      // Oblicz najbliższy slajd na podstawie pozycji paska
      var percent =
        parseFloat($progressBar.css('transform').split(',')[4]) / maxOffset;
      var totalSlides = $slider.slick('getSlick').slideCount;
      var newSlide = Math.round(percent * (totalSlides - 1));

      // Przejdź do wybranego slajdu
      $slider.slick('slickGoTo', newSlide);
    });
  });

  $('.polecane__slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 5000,
    arrows: false,
    dots: false,
    prevArrow: prevArrow,
    nextArrow: nextArrow,
    variableWidth: true,
    centerMode: true,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          arrows: false,
        },
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          arrows: false,
        },
      },
    ],
  });
  $(document).ready(function () {
    var $slider = $('.polecane__slider');
    var $progressBar = $('.polecane__progress-bar');
    var progressTrackWidth = 200;
    var progressBarWidth = 87;
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
      isDragging = true;
      startX = e.pageX || e.originalEvent.touches[0].pageX;
      startLeft = parseFloat($progressBar.css('transform').split(',')[4]) || 0;
      e.preventDefault();
    });

    $(document).on('mousemove touchmove', function (e) {
      if (!isDragging) return;
      var moveX = (e.pageX || e.originalEvent.touches[0].pageX) - startX;
      var newLeft = Math.min(Math.max(startLeft + moveX, 0), maxOffset);
      $progressBar.css('transform', `translateX(${newLeft}px)`);
    });

    $(document).on('mouseup touchend', function () {
      if (!isDragging) return;
      isDragging = false;

      // Oblicz najbliższy slajd na podstawie pozycji paska
      var percent =
        parseFloat($progressBar.css('transform').split(',')[4]) / maxOffset;
      var totalSlides = $slider.slick('getSlick').slideCount;
      var newSlide = Math.round(percent * (totalSlides - 1));

      // Przejdź do wybranego slajdu
      $slider.slick('slickGoTo', newSlide);
    });
  });

  $('.home-zestaw__slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 5000,
    arrows: false,
    dots: false,
    prevArrow: prevArrow,
    nextArrow: nextArrow,
    variableWidth: true,
    centerMode: true,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          arrows: false,
        },
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          arrows: false,
        },
      },
    ],
  });

  $(document).ready(function () {
    var $slider = $('.home-zestaw__slider');
    var $progressBar = $('.home-zestaw__progress-bar');
    var progressTrackWidth = 200;
    var progressBarWidth = 87;
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
      isDragging = true;
      startX = e.pageX || e.originalEvent.touches[0].pageX;
      startLeft = parseFloat($progressBar.css('transform').split(',')[4]) || 0;
      e.preventDefault();
    });

    $(document).on('mousemove touchmove', function (e) {
      if (!isDragging) return;
      var moveX = (e.pageX || e.originalEvent.touches[0].pageX) - startX;
      var newLeft = Math.min(Math.max(startLeft + moveX, 0), maxOffset);
      $progressBar.css('transform', `translateX(${newLeft}px)`);
    });

    $(document).on('mouseup touchend', function () {
      if (!isDragging) return;
      isDragging = false;

      // Oblicz najbliższy slajd na podstawie pozycji paska
      var percent =
        parseFloat($progressBar.css('transform').split(',')[4]) / maxOffset;
      var totalSlides = $slider.slick('getSlick').slideCount;
      var newSlide = Math.round(percent * (totalSlides - 1));

      // Przejdź do wybranego slajdu
      $slider.slick('slickGoTo', newSlide);
    });
  });
};

export default slickCall;
