/*
 * This script initializes the accordion functionality for FAQ sections.
 * It toggles the visibility of content when the trigger is clicked.
 * It also manages the aria attributes for accessibility.
 */

$(document).ready(function ($) {
  const accordions = document.querySelectorAll('.accordion');

  accordions.forEach((accordion) => {
    const trigger = item.querySelector('.accordion__trigger');
    const content = item.querySelector('.accordion__content');

    trigger.addEventListener('click', () => {
      accordion.classList.toggle('accordion--collapsed');

      if (accordion.classList.contains('accordion--collapsed')) {
        // accordion is collapsed
        content.style.maxHeight = null;
        content.setAttribute('aria-hidden', true);
        trigger.setAttribute('aria-expanded', false);
      } else {
        // accordion is expanded
        content.style.maxHeight = content.scrollHeight + 'px';
        content.setAttribute('aria-hidden', false);
        trigger.setAttribute('aria-expanded', true);
      }
    });
  });
});
