'use strict';

import slickCall from './modules/slick';
import cf7FloatingLabels from './modules/cf7FloatingLabels';
import scrollAnim from './modules/scrollAnim';

jQuery(document).ready(function ($) {
  cf7FloatingLabels($);

  scrollAnim($);
  slickCall($);

  document.querySelectorAll('.accordion__trigger').forEach(trigger => {
    trigger.addEventListener('click', ()=> {
      const content = trigger.nextElementSibling;
      trigger.parentElement.classList.toggle('active');
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + 'px';
      }
    });
  });
});
