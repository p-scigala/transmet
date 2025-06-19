const scrollAnim = ($) => {
    function checkVisibility() {
        var scrollPosition = $(window).scrollTop();
        var windowHeight = $(window).height();
         
          $('.scroll-anim').each(function () {
            var $element = $(this); 
            var targetPosition = $element.offset().top + 100;
            var targetPosition2 = $element.offset().top ;
            if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
                    $element.addClass('anim');
            } else if(scrollPosition + windowHeight <= targetPosition2 && scrollPosition) {
              $element.removeClass('anim');
            }
          });

          $('.scroll-anim-delay').each(function () { 
            var $element = $(this); 
            var targetPosition = $element.offset().top + 100;
            var targetPosition2 = $element.offset().top;
        
            if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
                setTimeout(function() {
                    $element.addClass('anim');
                }, 1000); // Opóźnienie 1s (1000ms)
            } else if (scrollPosition + windowHeight <= targetPosition2 && scrollPosition) {
                $element.removeClass('anim');
            }
        });
        

          $('.scroll-anim-top').each(function () {
            var $element = $(this); 
            var targetPosition = $element.offset().top + 100;
            if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
                    $element.addClass('anim');
            } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
                    $element.removeClass('anim');
            }
          });


          $('.scroll-anim-bottom').each(function () {
            var $element = $(this); 
            var targetPosition = $element.offset().top + 100;
            if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
                    $element.addClass('anim');
            } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
                    $element.removeClass('anim');
            }
          });

          $('.scroll-anim-right').each(function () {
            var $element = $(this); 
            var targetPosition = $element.offset().top + 100;
            if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
                    $element.addClass('anim');
            } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
              $element.removeClass('anim');
            }
          });

          $('.scroll-anim-left').each(function () {
            var $element = $(this); 
            var targetPosition = $element.offset().top + 100;
            if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
                    $element.addClass('anim');
            } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
              $element.removeClass('anim');
            }
          });

          $('.scroll-anim-blur').each(function () {
            var $element = $(this); 
            var targetPosition = $element.offset().top + 100;
            if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
                    $element.addClass('anim');
            } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
              $element.removeClass('anim');
            }
          });



          $('.home-icons__icn-wrapper, .pobieranie__outline, .post-item-first, .post-item, .cta__outline, .product-item__img-wrapper, .product-hero__img-wrapper, .product-repeater__img-wrapper, .video__wrapper, .single-post__img-wrapper, .contact-form__wrapper').each(function () {
            var $element = $(this);
            var $decorators = $element.find('.corner-decor__L-T, .corner-decor__L-B, .corner-decor__R-T, .corner-decor__R-B');
            var targetPosition = $element.offset().top + 400;
            var targetPosition2 = $element.offset().top + 100;
        
            if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
                $decorators.addClass('anim');
            } else if (scrollPosition + windowHeight <= targetPosition2) {
                $decorators.removeClass('anim');
            }
        });
        
        


          // $('.corner-decor__L-T').each(function () {
          //   var $element = $(this); 
          //   var targetPosition = $element.offset().top + 300;
          //   if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
             
          //       $element.addClass('anim');
       
          //   } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
          //     $element.removeClass('anim');
          //   }
          // });

          // $('.corner-decor__L-B').each(function () {
          //   var $element = $(this); 
          //   var targetPosition = $element.offset().top + 300;
          //   if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
             
          //       $element.addClass('anim');
       
          //   } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
          //     $element.removeClass('anim');
          //   }
          // });

          // $('.corner-decor__R-T').each(function () {
          //   var $element = $(this); 
          //   var targetPosition = $element.offset().top + 300;
          //   if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
         
          //       $element.addClass('anim');
      
          //   } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
          //     $element.removeClass('anim');
          //   }
          // });

          // $('.corner-decor__R-B').each(function () {
          //   var $element = $(this); 
          //   var targetPosition = $element.offset().top + 300;
          //   if (scrollPosition + windowHeight >= targetPosition && scrollPosition <= targetPosition + $element.outerHeight() - $element.outerHeight() * 1.5) {
    
          //       $element.addClass('anim');
          
          //   } else if(scrollPosition + windowHeight <= targetPosition && scrollPosition) {
          //     $element.removeClass('anim');
          //   }
          // });

          
    

          

    }
      
      checkVisibility();
      
      $(window).scroll(function () {
        checkVisibility();
      });
      
    

      setTimeout(function() {
        $('.scroll-down').addClass('animated');
        $('.trusted__wrapper').addClass('animated');
    }, 400);






    $(document).ready(function() {
      // Funkcja sprawdzająca, czy elementy są widoczne na ekranie
      function isElementInViewport(el) {
          var rect = el.getBoundingClientRect();
          return (
              rect.top >= 0 &&
              rect.left >= 0 &&
              rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
              rect.right <= (window.innerWidth || document.documentElement.clientWidth)
          );
      }
      
      // Funkcja do animowania liczby
      function animateNumber($element, endNumber, unit) {
          $element.text('0' + unit);
          $({ countNum: 0 }).animate({ countNum: endNumber }, {
              duration: 800,
              easing: 'linear',
              step: function() {
                  $element.text(Math.floor(this.countNum) + unit);
              },
              complete: function() {
                  $element.text(endNumber + unit);
              }
          });
      }
      
      // Sprawdzanie widoczności elementów podczas scrollowania
      $(window).on('scroll', function() {
          $('.about-numbers__number').each(function() {
              var $number = $(this);
              if (! $number.hasClass('animated') && isElementInViewport($number.get(0))) {
                  var originalText = $number.text();
                  var numberWithoutUnit = parseInt(originalText, 10);
                  var unit = originalText.replace(numberWithoutUnit, ''); // Pobierz jednostkę
                  animateNumber($number, numberWithoutUnit, unit);
                  $number.addClass('animated'); // Dodaj klasę, że animacja została zakończona
              }
          });
      });
      
      // Pokaż elementy, gdy są gotowe do animacji
      $(window).trigger('scroll');
  });
  
};
  
export default scrollAnim;